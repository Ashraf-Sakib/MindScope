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

      <!-- Recent Mood Entries -->
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

      <!-- Take Note Card -->
      <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div class="card bg-base-100 text-base-content border-2 border-primary shadow-xl">
          <figure class="px-6 pt-6">
            <img src="{{ asset('images/note.png') }}" alt="take note" class="rounded-xl w-48 h-48 object-cover"/>
          </figure>
          <div class="card-body items-center text-center">
            <h2 class="card-title">Take Note</h2>
            <p>Write about your current feelings</p>
            <div class="card-actions">
              <a href="{{ route('moods.index') }}" class="btn btn-primary">Add note</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Wizard Cat Chat Widget -->
<div id="wizardChatContainer" class="fixed bottom-6 right-6 z-50">
    <!-- Floating Chat Button -->
    <button id="openWizardChat"
        class="shadow-2xl hover:scale-110 transition-transform rounded-full overflow-hidden border-4 border-primary bg-base-100">
        <img src="{{ asset('images/Wizard Cat.jpg') }}" alt="wizard cat" class="w-16 h-16 object-cover"/>
    </button>

    <!-- Chat Modal -->
    <div id="wizardChatModal" class="hidden fixed bottom-24 right-6 w-80 sm:w-96 bg-base-100 rounded-2xl shadow-2xl border-2 border-primary">
        <div class="bg-primary text-primary-content p-4 rounded-t-2xl flex justify-between items-center">
            <h3 class="font-bold text-lg">🐱 Wizard Cat</h3>
            <button id="closeWizardChat" class="btn btn-sm btn-ghost btn-circle">✕</button>
        </div>

        <div id="chatMessages" class="p-4 h-64 overflow-y-auto space-y-3 bg-base-200">
            <div class="chat chat-start">
                <div class="chat-bubble chat-bubble-secondary">
                    Hi there! I'm Wizard Cat 🪄 Tell me how you feel today!
                </div>
            </div>
        </div>

        <div class="p-4 border-t-2 border-base-300 flex gap-2 bg-base-100 rounded-b-2xl">
            <input id="chatInput" type="text" placeholder="Type a message..." 
                   class="input input-bordered w-full" />
            <button id="sendChat" class="btn btn-primary">
                <span id="sendBtnText">Send</span>
                <span id="sendBtnLoader" class="loading loading-spinner loading-sm hidden"></span>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('openWizardChat');
    const closeBtn = document.getElementById('closeWizardChat');
    const modal = document.getElementById('wizardChatModal');
    const sendBtn = document.getElementById('sendChat');
    const input = document.getElementById('chatInput');
    const messages = document.getElementById('chatMessages');
    const sendBtnText = document.getElementById('sendBtnText');
    const sendBtnLoader = document.getElementById('sendBtnLoader');

    if (!openBtn || !closeBtn || !modal || !sendBtn || !input || !messages) {
        console.error('Chat widget elements not found');
        return;
    }

    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        input.focus();
    });

    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keypress', (e) => { 
        if (e.key === 'Enter' && !sendBtn.disabled) sendMessage(); 
    });

    async function sendMessage() {
        const text = input.value.trim();
        if (!text) return;
        sendBtn.disabled = true;
        input.disabled = true;
        sendBtnText.classList.add('hidden');
        sendBtnLoader.classList.remove('hidden');

        // Add user message
        const userMsg = document.createElement('div');
        userMsg.className = 'chat chat-end';
        userMsg.innerHTML = `<div class="chat-bubble chat-bubble-primary">${escapeHtml(text)}</div>`;
        messages.appendChild(userMsg);

        input.value = '';
        messages.scrollTop = messages.scrollHeight;

        try {
            // Call the API
            const response = await fetch('{{ route("wizard-cat.respond") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: text })
            });
            const data = await response.json();
            console.log('API Response:', data);

            if (!response.ok) {
                console.error('Response status:', response.status);
                console.error('Response data:', data);
                throw new Error(data.reply || `Server returned ${response.status}`);
            }

            if (!data.reply) {
                throw new Error('No reply received from API');
            }
            const botMsg = document.createElement('div');
            botMsg.className = 'chat chat-start';
            botMsg.innerHTML = `<div class="chat-bubble chat-bubble-secondary">${escapeHtml(data.reply)}</div>`;
            messages.appendChild(botMsg);
            messages.scrollTop = messages.scrollHeight;

        } catch (error) {
            console.error('Caught Error:', error);
            console.error('Error type:', error.name);
            console.error('Error message:', error.message);
            const errorMsg = document.createElement('div');
            errorMsg.className = 'chat chat-start';
            errorMsg.innerHTML = `<div class="chat-bubble chat-bubble-error">Oops! ${escapeHtml(error.message)} 🐾</div>`;
            messages.appendChild(errorMsg);
            messages.scrollTop = messages.scrollHeight;
        } finally {
            sendBtn.disabled = false;
            input.disabled = false;
            sendBtnText.classList.remove('hidden');
            sendBtnLoader.classList.add('hidden');
            input.focus();
        }
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
});
</script>
</x-app-layout>