import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../api";

export default function SurveyForm() {
  const [title, setTitle] = useState("");
  const [description, setDescription] = useState("");
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    await api.post("/surveys", { title, description });
    alert("Survey created!");
    navigate("/");
  };

  return (
    <div className="p-4">
      <h2 className="text-xl mb-4">Create New Survey</h2>
      <form onSubmit={handleSubmit} className="flex flex-col gap-2 max-w-md">
        <input
          type="text"
          placeholder="Survey Title"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          className="border p-2"
        />
        <textarea
          placeholder="Survey Description"
          value={description}
          onChange={(e) => setDescription(e.target.value)}
          className="border p-2"
        />
        <button className="bg-blue-500 text-white p-2 rounded">Save</button>
      </form>
    </div>
  );
}
