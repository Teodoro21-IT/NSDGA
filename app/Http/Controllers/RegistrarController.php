<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentEnrollmentForm;
use Carbon\Carbon;

class RegistrarController extends Controller
{
    public function index()
    {
        // 1. Define Time Thresholds
        $tenDaysAgo = Carbon::now()->subDays(10);
        $currentYear = Carbon::now()->year;
        $lastYear = Carbon::now()->subYear()->year;

        // 2. Count Urgent Tasks (Submitted 10+ days ago and not yet enrolled)
        $urgentTasks = StudentEnrollmentForm::where('created_at', '<=', $tenDaysAgo)
            ->where('student_type', '!=', 'enrolled') 
            ->count();

        // 3. Year-over-Year Comparison
        $thisYearSubmissions = StudentEnrollmentForm::whereYear('created_at', $currentYear)->count();
        $lastYearSubmissions = StudentEnrollmentForm::whereYear('created_at', $lastYear)->count();

        // Calculate Growth Percentage (Standard formula: ((New - Old) / Old) * 100)
        $growth = 0;
        if ($lastYearSubmissions > 0) {
            $growth = (($thisYearSubmissions - $lastYearSubmissions) / $lastYearSubmissions) * 100;
        }

        // 4. General Statistics
        $totalPending = StudentEnrollmentForm::where('student_type', 'new')->count();
        $docsForReview = StudentEnrollmentForm::count(); 
        
        // Fetch 20 most recent applications for the dashboard table
        $newestApplications = StudentEnrollmentForm::latest()->take(20)->get();

        return view('registrar.registrar_dashboard', compact(
            'totalPending', 
            'docsForReview', 
            'urgentTasks', 
            'newestApplications',
            'thisYearSubmissions',
            'lastYearSubmissions',
            'growth'
        ));
    }
}