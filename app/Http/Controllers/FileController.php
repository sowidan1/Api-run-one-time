<?php

namespace App\Http\Controllers;

class FileController extends Controller
{
    public function file()
    {
        // Define the file path relative to the project root
        $filePath = base_path('data.json');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Read the current contents of the file
        $jsonData = file_get_contents($filePath);

        // Decode the JSON to an array
        $data = json_decode($jsonData, true);

        // Add new data
        $newData = [
            "name" => "gggggg",
            "age" => 35,
            "job" => "Designer"
        ];
        $data[] = $newData;

        // Encode back to JSON and save
        $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($filePath, $updatedJsonData);

        return response()->json(['message' => 'Data added successfully']);
    }
}
