<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Pageindexactivity extends Component
{
    public $currentMonth;
    public $currentYear;
    public $activities = [];
    public $calendar = [];

    public function mount()
    {
        $now = Carbon::now();

        $this->currentMonth = $now->month;
        $this->currentYear = $now->year;

        $this->loadActivities();
        $this->generateCalendar();
    }

    public function loadActivities()
    {
        $this->activities = DB::table('activity')
            ->where('status', 'Y')
            ->whereMonth('activity_date', $this->currentMonth)
            ->whereYear('activity_date', $this->currentYear)
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->activity_date)->day;
            })->toArray();
    }

    public function generateCalendar()
    {
        $firstDayOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $daysInMonth = $firstDayOfMonth->daysInMonth;
        $startDayOfWeek = $firstDayOfMonth->dayOfWeekIso; // Monday = 1

        $calendar = [];

        // fill null until start day
        for ($i = 1; $i < $startDayOfWeek; $i++) {
            $calendar[] = null;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $calendar[] = $day;
        }

        $this->calendar = $calendar;
    }

    public function gotoPrevMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->loadActivities();
        $this->generateCalendar();
    }

    public function gotoNextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->loadActivities();
        $this->generateCalendar();
    }

    public function render()
    {
        return view('livewire.user.pageindexactivity');
    }
}