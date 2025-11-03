<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function store(Request $request, Question $question)
{
$data = $request->validate([
'text' => 'required|string',
'order' => 'integer',
]);


$option = $question->options()->create($data);
return response()->json($option, 201);
}


public function update(Request $request, Option $option)
{
$data = $request->validate([
'text' => 'string',
'order' => 'integer',
]);


$option->update($data);
return response()->json($option);
}
public function destroy(Option $option)
{
$option->delete();
return response()->json(['message' => 'Option deleted']);
}
}
