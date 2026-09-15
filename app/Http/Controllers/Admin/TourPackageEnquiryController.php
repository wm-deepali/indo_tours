<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourPackageEnquiry;
use Illuminate\Http\Request;

class TourPackageEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $enquiries = TourPackageEnquiry::with('tourPackage')
            ->when($request->filled('status'), fn($q) => $q->where('status', $request->status))
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($sub) use ($search) {
                    $sub->where('full_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.package-enquiries.index', compact('enquiries'));
    }

    public function show(TourPackageEnquiry $package_enquiry)
    {
        $package_enquiry->load('tourPackage');

        return view('admin.package-enquiries.show', [
            'enquiry' => $package_enquiry,
        ]);
    }

    public function updateStatus(Request $request, TourPackageEnquiry $package_enquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,converted,closed',
        ]);

        $package_enquiry->update($validated);

        return back()->with('success', 'Enquiry status updated.');
    }

    public function destroy(TourPackageEnquiry $package_enquiry)
    {
        $package_enquiry->delete();

        return redirect()
            ->route('admin.package-enquiries.index')
            ->with('success', 'Enquiry deleted successfully.');
    }
}