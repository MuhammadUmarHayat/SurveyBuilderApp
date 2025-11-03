import React, { useEffect, useState } from 'react';
import api from '../api';

export default function SurveyResults({ surveyId }) {
  const [results, setResults] = useState(null);

  useEffect(() => {
    api.get(`/surveys/${surveyId}/results`)
      .then(res => setResults(res.data))
      .catch(console.error);
  }, [surveyId]);

  if (!results) return <p>Loading results...</p>;

  return (
    <div>
      <h3>Survey Results</h3>
      {results.map((r, i) => (
        <div key={i}>
          <p>{r.question}: {r.answer}</p>
        </div>
      ))}
    </div>
  );
}
