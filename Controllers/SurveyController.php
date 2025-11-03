<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function index()
{
return Survey::withCount('questions')->get();
}


public function store(Request $request)
{
$data = $request->validate([
'title' => 'required|string|max:255',
'description' => 'nullable|string',
'is_active' => 'boolean',
]);


$survey = Survey::create($data);
return response()->json($survey, 201);
}

public function show(Survey $survey)
{
$survey->load('questions.options');
return response()->json($survey);
}


public function update(Request $request, Survey $survey)
{
$data = $request->validate([
'title' => 'string|max:255',
'description' => 'nullable|string',
'is_active' => 'boolean',
]);


$survey->update($data);
return response()->json($survey);
}


public function destroy(Survey $survey)
{
$survey->delete();
return response()->json(['message' => 'Survey deleted']);
}
}