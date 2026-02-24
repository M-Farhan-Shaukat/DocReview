<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\FinalForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class FinalFormController extends Controller

{
    public function index()
    {
        $disableNewApplicationButton = false;
        $applications = FinalForm::where('user_id', auth()->id());
        if(count($applications->get()) > 0){
            $disableNewApplicationButton = true;
        }
        $applications=$applications->latest()
            ->paginate(10);
        foreach ($applications as $application) {
            $enableEditButton = false;
//            if($application->status != 'approved'){
//                $enableEditButton = true;
//            }
            $application->show_edit_button = $enableEditButton;
        }

        return view('user.finalDocument.index', compact('applications','disableNewApplicationButton'));
    }

    public function create()
    {
        $user = auth()->user();
        $application =  Application::where('user_id',auth()->id())->where('status','approved')->first();
        return view('user.finalDocument.create',compact('application','user'));
    }

    public function preview(Request $request)
    {
        $validated = $request->validate([
            'district' => 'required',
            'registration_no' => 'required',
            'security_code' => 'required',
            'name' => 'required',
            'cnic' => 'required',
            'relation_detail' => 'required',
            'current_mailing_address' => 'required',
            'permanent_mailing_address' => 'required',
            'occupation' => 'required',
            'email' => 'required|email',
            'official_contact_number' => 'required',
            'mobile_number' => 'required',
            'amount_in_words' => 'required',
            'dated' => 'required',
            'total_amount' => 'required',
            'booked_by_code' => 'required',
            'booking_date' => 'required',
        ]);

        // Temporarily store files
        if ($request->hasFile('cnic_copy')) {
            $validated['cnic_copy'] = $request->file('cnic_copy')->store('temp');
        }

        if ($request->hasFile('deposit_copy')) {
            $validated['deposit_copy'] = $request->file('deposit_copy')->store('temp');
        }

        return view('final_forms.preview', compact('validated'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'district' => 'required',
            'registration_no' => 'required',
            'security_code' => 'required',
            'name' => 'required',
            'cnic' => 'required',
            'guardian_name' => 'required',
            'current_mailing_address' => 'required',
            'permanent_mailing_address' => 'required',
            'occupation' => 'required',
            'email' => 'required|email',
            'official_contact_number' => 'required',
            'mobile_number' => 'required',
            'amount_in_words' => 'required',
            'payment_date' => 'required',
            'total_amount' => 'required',
            'booked_by' => 'required',
            'booking_date' => 'required',
        ]);
        if ($request->hasFile('cnic_copy')) {
            $validated['cnic_copy'] = $request->file('cnic_copy')->store('temp');
        }

        if ($request->hasFile('deposit_copy')) {
            $validated['deposit_copy'] = $request->file('deposit_copy')->store('temp');
        }

        $finalForm =  FinalForm::create([
            'user_id' => Auth::id(),
            'district' => $validated['district'],
            'registration_no' => $validated['registration_no'],
            'security_code' => $validated['security_code'],
            'name' => $validated['name'],
            'cnic' => $validated['cnic'],
            'guardian_name' => $validated['guardian_name'],
            'current_mailing_address' => $validated['current_mailing_address'],
            'permanent_mailing_address' => $validated['permanent_mailing_address'],
            'occupation' => $validated['occupation'],
            'email' => $validated['email'],
            'official_contact_number' => $validated['official_contact_number'],
            'mobile_number' => $validated['mobile_number'],
            'amount_in_words' => $validated['amount_in_words'],
            'payment_date' => $validated['payment_date'],
            'total_amount' => $validated['total_amount'],
            'booked_by' => $validated['booked_by'],
            'booking_date' => $validated['booking_date'],
        ]);

        if ($request->hasFile('cnic_copy')) {

            $file = $request->file('cnic_copy');

            $path = $file->store(
                'registerForm/' . $finalForm->id,
                'public'
            );
            $finalForm->update([
                'cnic_copy' => $path,
            ]);
        }
        if ($request->hasFile('deposit_copy')) {

            $file = $request->file('deposit_copy');

            $path = $file->store(
                'registerForm/' . $finalForm->id,
                'public'
            );

            $finalForm->update([
                'deposit_copy' => $path,
            ]);
        }

        return redirect()->route('user.dashboard')
            ->with('success', 'Form submitted successfully.');
    }
}
