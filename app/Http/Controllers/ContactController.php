<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;

use App\Contact;

class ContactController extends Controller
{
    /**
     * AJAX Function: Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        return Response::json(json_encode($contact));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = 'error';

        try {
            $contact = Contact::findOrFail($id);

            $contact->delete();

            $type = 'success';
            $message = 'Succeeded deleting a feedback!';
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to delete a feedback! : ' . $e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }
}
