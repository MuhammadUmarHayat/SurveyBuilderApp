<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
 public function store(Request $request, Survey $survey)
{
$data = $request->validate([
'user_identifier' => 'nullable|string|max:255',
'answers' => 'required|array',
]);


DB::transaction(function () use ($survey, $data) {
$response = $survey->responses()->create([
'user_identifier' => $data['user_identifier'] ?? null,
]);


foreach ($data['answers'] as $a) {
if (!empty($a['option_ids'])) {
foreach ($a['option_ids'] as $optId) {
$response->answers()->create([
'question_id' => $a['question_id'],
'option_id' => $optId,
]);
}
} elseif (!empty($a['option_id'])) {
$response->answers()->create([
'question_id' => $a['question_id'],
'option_id' => $a['option_id'],
]);
} else {
$response->answers()->create([
'question_id' => $a['question_id'],
'text' => $a['text'] ?? null,
]);
}
}
});


return response()->json(['message' => 'Response submitted successfully'], 201);
}
public function results(Survey $survey)
{
$questions = $survey->questions()->with('options')->get()->map(function ($q) use ($survey) {
if ($q->type === 'text') {
$answers = DB::table('answers')
->where('question_id', $q->id)
->join('responses', 'answers.response_id', '=', 'responses.id')
->where('responses.survey_id', $survey->id)
->select('answers.text')
->limit(50)
->get();
return ['question' => $q, 'answers' => $answers];
}


$total = DB::table('answers')
->join('responses', 'answers.response_id', '=', 'responses.id')
->where('responses.survey_id', $survey->id)
->where('answers.question_id', $q->id)
->count();
$counts = DB::table('answers')
->join('responses', 'answers.response_id', '=', 'responses.id')
->where('responses.survey_id', $survey->id)
->where('answers.question_id', $q->id)
->select('option_id', DB::raw('COUNT(*) as cnt'))
->groupBy('option_id')
->pluck('cnt', 'option_id');


$options = $q->options->map(function ($opt) use ($counts, $total) {
$count = $counts[$opt->id] ?? 0;
$pct = $total ? round($count / $total * 100, 2) : 0;
return ['id' => $opt->id, 'text' => $opt->text, 'count' => $count, 'pct' => $pct];
});


return ['question' => $q, 'options' => $options, 'total' => $total];
});


return response()->json(['survey' => $survey, 'questions' => $questions]);
}
}