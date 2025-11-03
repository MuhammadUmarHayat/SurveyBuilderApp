<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    
public function store(Request $request, Survey $survey)
{
$data = $request->validate([
'text' => 'required|string',
'type' => 'required|in:single,multiple,text',
'required' => 'boolean',
'order' => 'integer',
]);


$question = $survey->questions()->create($data);
return response()->json($question, 201);
}


public function update(Request $request, Question $question)
{
$data = $request->validate([
'text' => 'string',
'type' => 'in:single,multiple,text',
'required' => 'boolean',
'order' => 'integer',
]);


$question->update($data);
return response()->json($question);
}
public function destroy(Question $question)
{
$question->delete();
return response()->json(['message' => 'Question deleted']);
}
}
