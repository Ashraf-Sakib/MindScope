<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
      <!-- Welcome Section -->
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h3 class="card-title text-lg">Welcome section</h3>
          <p class="text-base-content/70">
            Welcome back, {{ Auth::user()->name }}! ✨<br>
            Track your mood, reflect on your week, and chat with Wizard Cat for motivation 🐱🪄
          </p>
        </div>
      </div>

      <!-- Feature Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('moods.index') }}" class="block">
          <div class="card bg-base-100 border-2 border-error hover:shadow-2xl transition-all">
            <div class="card-body items-center text-center">
              <div class="mb-4">
                <img src="{{ asset('images/mood entry.png') }}" alt="Mood Entry" class="w-12 h-12"/>
              </div>
              <h3 class="card-title text-error">Mood Entry</h3>
              <p class="text-error/70">Log your feelings and add notes</p>
            </div>
          </div>
        </a>

        <a href="{{ route('relief') }}" class="block">
          <div class="card bg-base-100 border-2 border-warning hover:shadow-2xl transition-all">
            <div class="card-body items-center text-center">
              <div class="mb-4">
                <img src="{{ asset('images/instant relief.png') }}" alt="Instant Relief" class="w-12 h-12"/>
              </div>
              <h3 class="card-title text-warning">Instant Relief</h3>
              <p class="text-warning/70">Try breathing exercises or meditation</p>
            </div>
          </div>
        </a>

        <a href="{{ route('weekly.report') }}" class="block">
          <div class="card bg-base-100 border-2 border-info hover:shadow-2xl transition-all">
            <div class="card-body items-center text-center">
              <div class="mb-4">
                <img src="{{ asset('images/weekly report.png') }}" alt="Weekly Report" class="w-12 h-12"/>
              </div>
              <h3 class="card-title text-info">Weekly Report</h3>
              <p class="text-info/70">See how your week has been</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Recent Mood Entries -->
      <div class="card bg-base-100 border-2 border-success shadow-xl">
        <div class="card-body">
          <div class="flex items-center mb-4">
            <span class="text-2xl mr-3">📊</span>
            <h3 class="card-title text-success">Recent Mood Entries</h3>
          </div>
          
          @if($recentMoods->isEmpty())
            <div class="text-center py-8">
              <p class="text-success text-lg">No moods logged yet. Start tracking today! 🌟</p>
            </div>
          @else
            <div class="overflow-x-auto">
              <table class="table table-zebra">
                <thead>
                  <tr>
                    <th class="text-success">Date</th>
                    <th class="text-success">Mood</th>
                    <th class="text-success">Note</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentMoods as $mood)
                    <tr>
                      <td>{{ $mood->created_at->format('M d, Y') }}</td>
                      <td>
                        <span class="badge badge-lg
                          @if($mood->mood === 'happy') badge-success
                          @elseif($mood->mood === 'sad') badge-info
                          @elseif($mood->mood === 'anxious') badge-warning
                          @elseif($mood->mood === 'angry') badge-error
                          @else badge-ghost @endif">
                          {{ ucfirst($mood->mood) }}
                        </span>
                      </td>
                      <td>{{ Str::limit($mood->note, 50) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>

      <!-- Bottom Action Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card bg-base-100 border-2 border-primary shadow-xl">
          <figure class="px-6 pt-6">
            <img src="{{ asset('images/note.png') }}" alt="take note" class="rounded-xl w-48 h-48 object-cover"/>
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Take Note</h2>
            <p>Write about your current feelings</p>
            <div class="card-actions">
              <button class="btn btn-primary">Add note</button>
            </div>
          </div>
        </div>

        <div class="card bg-base-100 border-2 border-accent shadow-xl">
          <figure class="px-6 pt-6">
            <img src="{{ asset('images/Wizard Cat.jpg') }}" alt="wizard cat" class="rounded-xl w-48 h-48 object-cover"/>
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Wizard Cat</h2>
            <p>Your personal motivator and chat companion! 🐱🪄</p>
            <div class="card-actions">
              <button class="btn btn-primary">Chat Now</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</x-app-layout>