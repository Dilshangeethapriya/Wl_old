<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Tickets;
use App\Models\TicketReply;
use App\Models\CallbackRequest;
use Carbon\Carbon;
use Egulias\EmailValidator\EmailValidator;  // email avalidation library
use Egulias\EmailValidator\Validation\RFCValidation; 
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryReplyMail;


class inquiryController extends Controller
{
    public function index(){
        
        return view('/inquiry');
    }

    public function addInquiry(Request $request){
        
        $request->validate([
             'name' => 'required|max:100',
             'email' => ['required', 'email', function ($attribute, $value, $fail) {
                $validator = new EmailValidator();
                $validation = new RFCValidation();
                if (!$validator->isValid($value, $validation)) {
                    $fail('The '.$attribute.' is invalid.');
                }}],
             'phone' => 'required|min:10',
             'subject' => 'required|max:100',
             'message' => 'required|max:3000',
        ]);

        $inquiry = new Tickets;

        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->phone = $request->phone;
        $inquiry->subject = $request->subject;
        $inquiry->ticketType = "Inquiry Message";
        $inquiry->ticketText = $request->message;
        $inquiry->ticketStatus = "New";
        $inquiry->created_at = Carbon::now();
        $inquiry->updated_at = Carbon::now();
        
        $inquiry->save();

        return redirect()->route('inquiry')->with('success', 'Inquiry submitted successfully!');
    }

    public function addCallBackRequest(Request $request)
    {

       
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i',
        ]);

           $callbackRequests = new CallbackRequest;
           $callbackRequests->name = $request->name;
           $callbackRequests->phone = $request->phone;
            $callbackRequests->time_from = $request->time_from;
            $callbackRequests->time_to = $request->time_to;

            $callbackRequests->save();
     
        return redirect()->route('inquiry')->with('success', 'Callback request submitted successfully!');
    }
// ------------admin functions ------------

public function adminViewInquiriesAndCallbacks()
{


    $inquiries = Tickets::paginate(10);
    $callbackRequests = CallbackRequest::paginate(10);
    return view('admin.inquiry.index', [
        'inquiries' => $inquiries,
        'callbackRequests' => $callbackRequests
    ]);
}


    public function viewInquiry(int $ticketID){
        $inquiry = Tickets::where('ticketID',$ticketID)->first();
        if($inquiry === null){
            abort(404);
        }
        return view('admin.inquiry.viewInquiry',['inquiry'=> $inquiry]);
    }

    public function updateStatus(Request $request, int $ticketID)
    {
        // Validatin the input
        $request->validate([
            'status' => 'required|in:New,In Progress,Closed',
        ]);

        // select inquiry by the id
        $inquiry = Tickets::where('ticketID', $ticketID)->first();

        if ($inquiry === null) {
            abort(404, 'Inquiry not found.');
        }

        // Update the status value
        $inquiry->ticketStatus = $request->input('status');
        $inquiry->updated_at = now(); // Update the timestamp
        $inquiry->save();

        // Redirect 
        return redirect()->route('admin.inquiry.viewInquiry', $ticketID)
                         ->with('success', 'Inquiry status updated successfully!');
    }

    public function deleteInquiry(int $ticketID) {
        
        $inquiry = Tickets::find($ticketID);
    
        // Check if the inquiry exists
        if ($inquiry === null) {
            return redirect()->route('admin.inquiry.index')->with('error', 'Inquiry not found.');
        }
    
        // Delete the inquiry
        $inquiry->delete();
    
        // Redirect back to the inquiry list with a success message
        return redirect()->route('admin.inquiry.index')->with('success', 'Inquiry deleted successfully.');
    }

    public function reply(Request $request, $ticketID)
    {
        $inquiry = Tickets::findOrFail($ticketID);

        // Validate input
        $request->validate([
            'reply' => 'required|string',
        ]);

        // Send email
        Mail::to($inquiry->email)->send(new InquiryReplyMail($inquiry, $request->reply));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Reply sent successfully!');
    }


   //--------------- call back requests ---------

   public function viewCallback($id)
    {
        $callback = CallbackRequest::findOrFail($id);
        return view('admin.inquiry.viewcallback', compact('callback'));
    }

    public function deleteCallbackRequest($id)
    {
        $callback = CallbackRequest::findOrFail($id);
        $callback->delete();

        return redirect()->route('admin.inquiry.index')->with('success', 'Callback request deleted successfully.');
    }
    
    public function updateCallbackStatus(Request $request, $id)
   {
    // Validate the status input
    $request->validate([
        'status' => 'required|in:Pending,In Progress,Failed,Completed',
    ]);

    // Find the callback request by its ID
    $callback = CallbackRequest::findOrFail($id);

    // Update the status
    $callback->status = $request->input('status');
    $callback->updated_at = now();
    $callback->save();

    // Redirect back with a success message
    return redirect()->route('admin.inquiry.viewCallback', $id)->with('success', 'Callback request status updated successfully!');
   }

}

