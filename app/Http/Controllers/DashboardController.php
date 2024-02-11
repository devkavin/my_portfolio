<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with summary statistics and recent projects.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        // Fetch counts of various entities for quick stats
        $projectsCount = Project::count();
        $categoriesCount = Category::count();
        $tagsCount = Tag::count();

        // Fetch recent projects, for example, projects created in the last 30 days
        $recentProjects = Project::where('created_at', '>', Carbon::now()->subDays(30))
            ->orderBy('created_at', 'desc')
            ->take(5) // Limit to the 5 most recent projects
            ->get();

        // Optionally, prepare data for analytics (e.g., project creation trends)

        return view('dashboard', [
            'projectsCount' => $projectsCount,
            'categoriesCount' => $categoriesCount,
            'tagsCount' => $tagsCount,
            'recentProjects' => $recentProjects,
            // Include additional data as needed for analytics
        ]);
    }
}
