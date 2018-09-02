<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Person;

class PeopleController extends Controller
{
    public function index(Request $request){
        
        // Set any Pagination required
        if ($request->has('p')) {
            $page = $request->input('p');
        }
        else {
            $page = 0;
        }
        
        
        // Calculating number of pagination buttons
        $total = Person::count();
        $page_count = ceil($total / 3);
        
        // Retrieve Displayed Objects
        $people = Person::orderBy('id', 'desc')->skip($page * 3)->take(3)->get();;
        
        return view('welcome', compact('people', 'page_count', 'page'));
    }
    
    public function show(Person $person){
        return $person;
    }
    
    public function delete($id){
        Person::destroy($id);   
         return redirect('/');
    }
    
    public function edit(Person $person, Request $request){
        // update name if present
        if ($request->has('Name')) {
            $person->Name = $request->Name;
        }
        // update picture if present
        if ($request->hasFile('Picture')) {
            $file = $request->file('Picture');
            $person->Picture = $request->Picture;
            $file_name = rand(11111, 99999) . '-' . $person->Name . '.' . $file->getClientOriginalExtension();
            $request->Picture->move(public_path('images'), $file_name);
            $person->Picture = $file_name;
        }   
        $person->save();
        return redirect('/');
    }
    
    public function create(Request $request){
        
        $this->validate($request, [
           'Name' => 'required',
           'Picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2044',
        ]);
        $person = new Person;
        $person->Name = $request->Name;
        $file = $request->file('Picture');
        $file_name = rand(11111, 99999) . '-' . $person->Name . '.' . $file->getClientOriginalExtension();
        $request->Picture->move(public_path('images'), $file_name);
        
        $person->Picture = $file_name;
        $person->save();
        
        return redirect('/');
    }
}
