import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import api from "../api";

export default function AdminDashboard() {
  const [surveys, setSurveys] = useState([]);

  const loadSurveys = async () => {
    const res = await api.get("/surveys");
    setSurveys(res.data);
  };

  const deleteSurvey = async (id) => {
    if (window.confirm("Delete this survey?")) {
      await api.delete(`/surveys/${id}`);
      loadSurveys();
    }
  };

  useEffect(() => {
    loadSurveys();
  }, []);

  return (
    <div className="p-4">
      <h2 className="text-xl font-bold mb-4">Survey Dashboard</h2>
      <table className="border w-full">
        <thead>
          <tr className="bg-gray-100">
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          {surveys.map((s) => (
            <tr key={s.id} className="border-t">
              <td>{s.title}</td>
              <td>{s.description}</td>
              <td className="space-x-2">
                <Link to={`/survey/${s.id}/questions`} className="text-blue-600">
                  Manage Questions
                </Link>
                <button
                  onClick={() => deleteSurvey(s.id)}
                  className="text-red-600"
                >
                  Delete
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
