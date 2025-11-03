import React, { useEffect, useState } from 'react';
import api from '../api';

export default function TakeSurvey({ surveyId }) {
  const [survey, setSurvey] = useState(null);
  const [answers, setAnswers] = useState({});

  useEffect(() => {
    api.get(`/surveys/${surveyId}`)
      .then(res => setSurvey(res.data))
      .catch(console.error);
  }, [surveyId]);

  const handleChange = (qid, val) => {
    setAnswers(prev => ({ ...prev, [qid]: val }));
  };

  const handleSubmit = () => {
    api.post(`/surveys/${surveyId}/responses`, { answers })
      .then(() => alert('Response saved!'))
      .catch(console.error);
  };

  if (!survey) return <p>Loading...</p>;

  return (
    <div>
      <h2>{survey.title}</h2>
      {survey.questions.map(q => (
        <div key={q.id}>
          <label>{q.text}</label>
          <input
            type="text"
            onChange={e => handleChange(q.id, e.target.value)}
          />
        </div>
      ))}
      <button onClick={handleSubmit}>Submit</button>
    </div>
  );
}
