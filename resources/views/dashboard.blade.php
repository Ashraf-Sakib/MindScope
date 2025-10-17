<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
      <div class="card bg-base-100 text-base-content shadow-xl">
        <div class="card-body">
          <h3 class="card-title text-lg">Welcome section</h3>
          <p class="text-base-content/70">
            Welcome back, {{ Auth::user()->name }}! ✨<br>
            Track your mood, reflect on your week, and chat with Wizard Cat for motivation 🐱🪄
          </p>
        </div>
      </div>
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
          <div class="card bg-base-100 text-base-content border-2 border-warning hover:shadow-2xl transition-all">
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
          <div class="card bg-base-100 text-base-content border-2 border-info hover:shadow-2xl transition-all">
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

      <div class="card bg-base-100 text-base-content border-2 border-success shadow-xl">
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

      <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div class="card bg-base-100 text-base-content border-2 border-primary shadow-xl">
          <figure class="px-6 pt-6">
            <img src="{{ asset('images/note.png') }}" alt="take note" class="rounded-xl w-48 h-48 object-cover"/>
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Take Note</h2>
            <p>Write about your current feelings</p>
            <div class="card-actions">
              <a href="{{ route('journal.index') }}" class="btn btn-primary">Add note</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div id="wizard-cat"
     class="fixed bottom-10 right-10 z-50 cursor-pointer transition-transform duration-300 hover:scale-110">
    <img src="{{ asset('images/wizard_cat.png') }}" 
         alt="Wizard Cat" 
         class="w-20 h-auto select-none drop-shadow-lg" />
</div>

<div id="wizard-chat" 
     class="hidden fixed bottom-32 right-10 bg-base-100 shadow-xl border border-base-300 rounded-2xl w-80 p-4 space-y-3 z-50">
    <div class="flex justify-between items-center border-b pb-2 mb-2">
        <h3 class="font-semibold text-lg text-primary">Wizard Cat 🪄</h3>
        <button id="close-wizard-chat" class="btn btn-xs btn-circle btn-ghost">✕</button>
    </div>

    <div id="wizard-chat-messages" class="h-60 overflow-y-auto space-y-2 bg-base-200 p-2 rounded-lg">
        <div class="chat chat-start">
            <div class="chat-bubble chat-bubble-secondary">
                Hi there! I'm Wizard Cat 🐱 How are you feeling today?
            </div>
        </div>
    </div>

    <div class="flex gap-2 pt-2">
        <input id="wizard-chat-input" type="text" placeholder="Ask me anything..."
               class="input input-bordered w-full" />
        <button id="wizard-chat-send" class="btn btn-primary btn-sm">Send</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cat = document.getElementById('wizard-cat');
        const chat = document.getElementById('wizard-chat');
        const closeBtn = document.getElementById('close-wizard-chat');
        const sendBtn = document.getElementById('wizard-chat-send');
        const input = document.getElementById('wizard-chat-input');
        const messages = document.getElementById('wizard-chat-messages');

        cat.addEventListener('click', () => {
            chat.classList.toggle('hidden');
            cat.classList.toggle('scale-95');
        });

        closeBtn.addEventListener('click', () => {
            chat.classList.add('hidden');
            cat.classList.remove('scale-95');
        });

        sendBtn.addEventListener('click', () => {
            const text = input.value.trim();
            if (text !== '') {
                const userMsg = document.createElement('div');
                userMsg.className = 'chat chat-end';
                userMsg.innerHTML = `<div class="chat-bubble chat-bubble-primary">${text}</div>`;
                messages.appendChild(userMsg);
                input.value = '';
                messages.scrollTop = messages.scrollHeight;

                setTimeout(() => {
                    const reply = document.createElement('div');
                    reply.className = 'chat chat-start';
                    reply.innerHTML = `<div class="chat-bubble chat-bubble-secondary">Hmm... interesting 😺</div>`;
                    messages.appendChild(reply);
                    messages.scrollTop = messages.scrollHeight;
                }, 800);
            }
        });

        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendBtn.click();
            }
        });
    });
</script>

</x-app-layout>