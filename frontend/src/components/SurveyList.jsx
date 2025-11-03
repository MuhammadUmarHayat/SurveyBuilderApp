import React, { useEffect, useState } from 'react';
import api from '../api';

export default function SurveyList() {
  const [surveys, setSurveys] = useState([]);

  useEffect(() => {
    api.get('/surveys')
      .then(res => setSurveys(res.data))
      .catch(err => console.error(err));
  }, []);

  return (
    <div className="p-4">
      <h2>Available Surveys</h2>
      <ul>
        {surveys.map(s => (
          <li key={s.id}>{s.title}</li>
        ))}
      </ul>
    </div>
  );
}
