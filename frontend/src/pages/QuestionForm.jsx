import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import api from "../api";

export default function QuestionForm() {
  const { id } = useParams();
  const [survey, setSurvey] = useState(null);
  const [questions, setQuestions] = useState([]);
  const [newQ, setNewQ] = useState("");

  const loadSurvey = async () => {
    const res = await api.get(`/surveys/${id}`);
    setSurvey(res.data);
    setQuestions(res.data.questions || []);
  };

  const addQuestion = async () => {
    if (!newQ.trim()) return;
    await api.post(`/surveys/${id}/questions`, { text: newQ, type: "text" });
    setNewQ("");
    loadSurvey();
  };

  const deleteQuestion = async (qid) => {
    await api.delete(`/questions/${qid}`);
    loadSurvey();
  };

  useEffect(() => {
    loadSurvey();
  }, [id]);

  if (!survey) return <p>Loading...</p>;

  return (
    <div className="p-4">
      <h2 className="text-xl mb-4">Questions for {survey.title}</h2>
      <div className="flex gap-2 mb-4">
        <input
          type="text"
          placeholder="Enter new question"
          value={newQ}
          onChange={(e) => setNewQ(e.target.value)}
          className="border p-2 w-full"
        />
        <button onClick={addQuestion} className="bg-green-500 text-white p-2 rounded">
          Add
        </button>
      </div>
      <ul>
        {questions.map((q) => (
          <li key={q.id} className="border p-2 flex justify-between items-center mb-2">
            {q.text}
            <button onClick={() => deleteQuestion(q.id)} className="text-red-600">
              Delete
            </button>
          </li>
        ))}
      </ul>
    </div>
  );
}
