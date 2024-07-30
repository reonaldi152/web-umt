<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalRequestApprovedNotification;
use App\Mail\ApprovalRequestRejectedNotification;
use App\Mail\ApprovalRequestSignedNotification;
use App\Mail\NewApprovalRequestNotification;
use App\Models\ApprovalRequest;
use App\Models\Kaprodi;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApprovalRequestController extends Controller
{
    public function create()
    {
        return view('user.aproval');
    }

    // Handle file upload
    // public function upload(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->back()->with('error', 'Anda harus login terlebih dahulu untuk mengunggah dokumen.');
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'document_name' => 'required|string',
    //         'document' => 'required|file|max:25600', // max file size 25MB
    //         'notes' => 'nullable|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $documentPath = $request->file('document')->store('documents');

    //     $approvalRequest = ApprovalRequest::create([
    //         'user_id' => Auth::id(),
    //         'document_name' => $request->input('document_name'),
    //         'document_path' => $documentPath,
    //         'notes' => $request->input('notes'),
    //     ]);

    //     // Send notification to Kaprodi
    //     Mail::to('reonaldi1105@gmail.com')->send(new NewApprovalRequestNotification($approvalRequest));

    //     return redirect('mahasiswa/status')->with('success', 'File uploaded successfully!');
    // }

    public function upload(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu untuk mengunggah dokumen.');
        }

        $validator = Validator::make($request->all(), [
            'document_name' => 'required|string',
            'document' => 'required|file|max:25600', // max file size 25MB
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $documentPath = $request->file('document')->store('documents');

        $approvalRequest = ApprovalRequest::create([
            'user_id' => Auth::id(),
            'document_name' => $request->input('document_name'),
            'document_path' => $documentPath,
            'notes' => $request->input('notes'),
        ]);

        // Mengambil email Kaprodi
        $kaprodiEmails = Kaprodi::pluck('email')->toArray();

        // Mengirim email notifikasi ke Kaprodi
        Mail::to($kaprodiEmails)->send(new \App\Mail\NewApprovalRequestNotification($approvalRequest));

        return redirect('mahasiswa/status')->with('success', 'File uploaded successfully!');
    }


    // Display all approval requests for Kaprodi
    public function index()
    {
        $approvalRequests = ApprovalRequest::all();
        return view('approval_requests.index', compact('approvalRequests'));
    }

    // Approve a request
    public function approve($id)
    {
        $approvalRequest = ApprovalRequest::findOrFail($id);
        $approvalRequest->update(['status' => 'approved']);

        Mail::to($approvalRequest->user->email)->send(new ApprovalRequestApprovedNotification($approvalRequest));

        return back()->with('success', 'Request approved successfully!');
    }

    // Reject a request
    public function reject($id)
    {
        $approvalRequest = ApprovalRequest::findOrFail($id);
        $approvalRequest->update(['status' => 'rejected']);

        // Send notification to student
        Mail::to($approvalRequest->user->email)->send(new ApprovalRequestRejectedNotification($approvalRequest));

        return back()->with('success', 'Request rejected successfully!');
    }

    // Display status of approval requests for the student
    public function status()
    {
        $approvalRequests = ApprovalRequest::where('user_id', Auth::id())->get();
        return view('approval_requests.status', compact('approvalRequests'));
    }

    // public function uploadSignedDocument(Request $request, $id)
    // {
    //     $request->validate([
    //         'signed_document' => 'required|file|max:25600', // max file size 25MB
    //     ]);

    //     $approvalRequest = ApprovalRequest::findOrFail($id);

    //     // Simpan path dokumen yang ditandatangani
    //     $signedDocumentPath = $request->file('signed_document')->store('signed_documents');
    //     $approvalRequest->update(['signed_document_path' => $signedDocumentPath]);

    //     // Buat URL unduhan untuk dokumen yang ditandatangani
    //     $downloadUrl = url('/approval-requests/download-signed/' . $approvalRequest->id);

    //     // Hasilkan QR code menggunakan endroid/qr-code
    //     $qrCode = new QrCode($downloadUrl);
    //     $writer = new PngWriter();
    //     $qrCodeImage = base64_encode($writer->write($qrCode)->getString());

    //     // Kirim notifikasi ke mahasiswa
    //     Mail::to($approvalRequest->user->email)->send(new ApprovalRequestSignedNotification($approvalRequest, $qrCodeImage));

    //     return back()->with('success', 'Signed document uploaded successfully!');
    // }

    public function uploadSignedDocument(Request $request, $id)
    {
        $request->validate([
            'signed_document' => 'required|file|max:25600', // max file size 25MB
        ]);

        $approvalRequest = ApprovalRequest::findOrFail($id);

        // Simpan path dokumen yang ditandatangani
        $signedDocumentPath = $request->file('signed_document')->store('signed_documents');
        $approvalRequest->update(['signed_document_path' => $signedDocumentPath]);

        // Buat URL unduhan untuk dokumen yang ditandatangani
        $downloadUrl = url('/approval-requests/download-signed/' . $approvalRequest->id);

        // Pastikan direktori `qrcodes` ada
        $qrCodeDirectory = storage_path('app/public/qrcodes');
        if (!File::exists($qrCodeDirectory)) {
            File::makeDirectory($qrCodeDirectory, 0755, true);
        }

        // Hasilkan QR code menggunakan endroid/qr-code dan simpan sebagai gambar
        $qrCode = new QrCode($downloadUrl);
        $writer = new PngWriter();
        $qrCodePath = 'qrcodes/' . $approvalRequest->id . '.png';
        $writer->write($qrCode)->saveToFile(storage_path('app/public/' . $qrCodePath));

        // URL gambar QR code
        $qrCodeUrl = Storage::url($qrCodePath);

        // Kirim notifikasi ke mahasiswa
        Mail::to($approvalRequest->user->email)->send(new ApprovalRequestSignedNotification($approvalRequest, $qrCodeUrl));

        return back()->with('success', 'Signed document uploaded successfully!');
    }

    public function downloadSignedDocument($id)
    {
        $approvalRequest = ApprovalRequest::findOrFail($id);

        // if ($approvalRequest->user_id !== Auth::guard('web')->id()) {
        //     abort(403, 'Unauthorized action.');
        // } else if ()

        $filePath = storage_path('app/' . $approvalRequest->signed_document_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $approvalRequest->document_name . '_signed.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }

    public function downloadDocument($id)
    {
        $approvalRequest = ApprovalRequest::findOrFail($id);

        // Pastikan hanya Kaprodi yang bisa melihat dokumen ini
        // if (!Auth::user()->isKaprodi()) {
        //     abort(403, 'Unauthorized action.');
        // }

        $filePath = storage_path('app/' . $approvalRequest->document_path);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath, $approvalRequest->document_name . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }

    public function showUploadForm()
    {
        $hasApprovalRequests = ApprovalRequest::where('user_id', Auth::id())->exists();
        return view('user.aproval', compact('hasApprovalRequests'));
    }
}
