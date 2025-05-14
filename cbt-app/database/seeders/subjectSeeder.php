<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class subjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = ['Mathematics', 'English Language', 'Physics', 'Chemistry', 'Biology', 'Economics', 'Government', 'Geography', 'History', 'Commerce', 'Civil  Education', 'Data Processing', 'Marketing', 'Further Mathematics', 'Literature in English', 'Agricultural Science', 'Creative Art', 'Computer Science', 'Christian Religion Knowledge', 'Basic Science', 'Basic Technology', 'Physical and Health Education','Food and Nutrition', 'Home Economics', 'French', 'Igbo', 'Yoruba', 'Hausa', 'Verbal Reasoning', 'Quantitative Reasoning', ] ;

        foreach ($subjects as  $subject) {
            Subject::created(['name' => $subject]);
            }
    }

  
}