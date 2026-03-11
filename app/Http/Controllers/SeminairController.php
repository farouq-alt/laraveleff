<?php

namespace App\Http\Controllers;

use App\Models\Seminaire;
use Illuminate\Http\Request;

class SeminairController extends Controller
{
    /**
     * Display a listing of all seminars.
     * This method shows the index page with all seminars.
     */
    public function index()
    {
        // Get all seminars with their animator information
        // with('animateur') loads the animator data at the same time
        $seminaires = Seminaire::with('animateur')->get();

        // Pass the seminars to the index view
        return view('seminaires.index', compact('seminaires'));
    }

    /**
     * Show the form for creating a new seminar.
     */
    public function create()
    {
        // This would show a form to create a new seminar
        // Not required for this assignment
    }

    /**
     * Store a newly created seminar in database.
     */
    public function store(Request $request)
    {
        // This would save a new seminar to database
        // Not required for this assignment
    }

    /**
     * Display the specified seminar with its details and activities.
     * This method shows the show page for one specific seminar.
     */
    public function show($id)
    {
        // Find the seminar by ID
        // with('animateur', 'activities') loads animator and activities data
        // findOrFail() shows 404 error if seminar doesn't exist
        $seminaire = Seminaire::with('animateur', 'activities')->findOrFail($id);

        // Pass the seminar to the show view
        return view('seminaires.show', compact('seminaire'));
    }

    /**
     * Show the form for editing the specified seminar.
     */
    public function edit($id)
    {
        // This would show a form to edit a seminar
        // Not required for this assignment
    }

    /**
     * Update the specified seminar in database.
     */
    public function update(Request $request, $id)
    {
        // This would update a seminar in database
        // Not required for this assignment
    }

    /**
     * Remove the specified seminar from database.
     * This method deletes a seminar and redirects with a success message.
     */
    public function destroy($id)
    {
        // Find the seminar by ID
        // findOrFail() shows 404 error if seminar doesn't exist
        $seminaire = Seminaire::findOrFail($id);

        // Delete the seminar from database
        $seminaire->delete();

        // Redirect back to the seminars list with a success message
        return redirect()->route('seminaires.index')
                         ->with('success', 'Séminaire supprimé avec succès');
    }
}
