import React from "react";
import { BrowserRouter, Routes, Route, Link } from "react-router-dom";
import AdminDashboard from "./pages/AdminDashboard";
import SurveyForm from "./pages/SurveyForm";
import QuestionForm from "./pages/QuestionForm";

export default function App() {
  return (
    <BrowserRouter>
      <nav className="p-4 bg-gray-200 flex gap-4">
        <Link to="/">Dashboard</Link>
        <Link to="/create-survey">Create Survey</Link>
      </nav>

      <Routes>
        <Route path="/" element={<AdminDashboard />} />
        <Route path="/create-survey" element={<SurveyForm />} />
        <Route path="/survey/:id/questions" element={<QuestionForm />} />
      </Routes>
    </BrowserRouter>
  );
}
