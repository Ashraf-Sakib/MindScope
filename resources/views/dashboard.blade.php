<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

      <!-- Welcome Card -->
      <div class="card bg-base-100 text-base-content shadow-xl">
        <div class="card-body">
          <p class="text-base-content/70">
            Welcome back, <b>{{ Auth::user()->name }}!</b> ✨<br>
            Track your mood, reflect on your week, and chat with Wizard Cat for motivation 🐱🪄
          </p>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('moods.index') }}" class="block">
          <div class="card bg-base-100 border-2 border-error hover:shadow-2xl transition-all">
            <div class="card-body items-center text-center">
              <img src="{{ asset('images/mood entry.png') }}" alt="Mood Entry" class="w-12 h-12 mb-4"/>
              <h3 class="card-title text-error">MindPulse</h3>
              <p class="text-error/70">Log your feelings and add short notes</p>
            </div>
          </div>
        </a>

        <!-- Instant Relief -->
        <a href="{{ route('relief') }}" class="block">
          <div class="card bg-base-100 text-base-content border-2 border-warning hover:shadow-2xl transition-all">
            <div class="card-body items-center text-center">
              <img src="{{ asset('images/instant relief.png') }}" alt="Instant Relief" class="w-12 h-12 mb-4"/>
              <h3 class="card-title text-warning">MindEase</h3>
              <p class="text-warning/70">Try breathing exercises or meditation</p>
            </div>
          </div>
        </a>

        <!-- Weekly Report -->
        <a href="{{ route('weekly.report') }}" class="block">
          <div class="card bg-base-100 text-base-content border-2 border-info hover:shadow-2xl transition-all">
            <div class="card-body items-center text-center">
              <img src="{{ asset('images/weekly report.png') }}" alt="Weekly Report" class="w-12 h-12 mb-4"/>
              <h3 class="card-title text-info">MindMirror</h3>
              <p class="text-info/70">See how your week has been</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Recent Moods -->
      <div class="card bg-base-100 text-base-content border-2 border-success shadow-xl">
        <div class="card-body">
          <div class="flex items-center mb-4">
            <span class="text-2xl mr-3">📊</span>
            <h3 class="card-title text-success">MindMoments</h3>
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

      <!-- Journal Section -->
      <div class="card bg-base-100 text-base-content border-2 border-primary shadow-xl">
        <div class="card-body p-0 grid grid-cols-1 md:grid-cols-2">
          
          <!-- Left: Carousel -->
          <div class="relative overflow-hidden p-6">
            <div id="journal-carousel" class="flex transition-transform duration-300 ease-in-out">
              @for($i = 1; $i <= 5; $i++)
                <div class="min-w-full flex-shrink-0">
                  <img src="{{ asset("images/Journal_$i.jpg") }}" alt="journal" class="rounded-xl w-full h-80 object-cover"/>
                </div>
              @endfor
            </div>

            <button id="prev-slide" class="absolute left-8 top-1/2 -translate-y-1/2 btn btn-circle btn-sm btn-primary opacity-75 hover:opacity-100">❮</button>
            <button id="next-slide" class="absolute right-8 top-1/2 -translate-y-1/2 btn btn-circle btn-sm btn-primary opacity-75 hover:opacity-100">❯</button>

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-2">
              @for($i = 0; $i < 5; $i++)
                <button class="carousel-dot w-3 h-3 rounded-full {{ $i === 0 ? 'bg-primary' : 'bg-base-300' }}" data-index="{{ $i }}"></button>
              @endfor
            </div>
          </div>

          <!-- Right: Note Section -->
          <div class="flex flex-col items-center justify-center text-center p-6 space-y-4">
            <img src="{{ asset('images/note.png') }}" alt="take note" class="rounded-xl w-48 h-48 object-cover"/>
            <h2 class="card-title text-2xl">MindDiary</h2>
            <p class="text-base-content/70">Whisper your feelings here</p>
            <a href="{{ route('journal.index') }}" class="btn btn-primary">Drop a thought</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Wizard Cat -->
  <div id="wizard-cat" class="fixed bottom-10 right-10 z-50 cursor-pointer transition-transform duration-300 hover:scale-110">
    <img src="{{ asset('images/wizard_cat.png') }}" alt="Wizard Cat" class="w-20 h-auto select-none drop-shadow-lg" />
  </div>

  <!-- Chat Box -->
  <div id="wizard-chat" class="hidden fixed bottom-32 right-10 bg-base-100 shadow-xl border border-base-300 rounded-2xl w-80 p-4 space-y-3 z-50">
    <div class="flex justify-between items-center border-b pb-2 mb-2">
      <h3 class="font-semibold text-lg text-primary">Wizard Cat 🪄</h3>
      <button id="close-wizard-chat" class="btn btn-xs btn-circle btn-ghost">✕</button>
    </div>

    <div id="wizard-chat-messages" class="h-60 overflow-y-auto space-y-2 bg-base-200 p-2 rounded-lg">
      <div class="chat chat-start">
        <div class="chat-bubble chat-bubble-secondary">Hi there! I'm Wise Wizard Cat. How are you feeling today?</div>
      </div>
    </div>

    <div class="flex gap-2 pt-2">
      <input id="wizard-chat-input" type="text" placeholder="Share your feelings..." class="input input-bordered w-full" />
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

      cat.addEventListener('click', () => chat.classList.toggle('hidden'));
      closeBtn.addEventListener('click', () => chat.classList.add('hidden'));

      sendBtn.addEventListener('click', async () => {
        const text = input.value.trim();
        if (!text) return;

        const userMsg = document.createElement('div');
        userMsg.className = 'chat chat-end';
        userMsg.innerHTML = `<div class="chat-bubble chat-bubble-primary">${text}</div>`;
        messages.appendChild(userMsg);
        input.value = '';
        messages.scrollTop = messages.scrollHeight;

        try {
          const response = await fetch('/wizard-cat/respond', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message: text })
          });

          const data = await response.json();
          const reply = document.createElement('div');
          reply.className = 'chat chat-start';
          reply.innerHTML = `<div class="chat-bubble chat-bubble-secondary">${data.reply}</div>`;
          messages.appendChild(reply);
          messages.scrollTop = messages.scrollHeight;
        } catch {
          const errorMsg = document.createElement('div');
          errorMsg.className = 'chat chat-start';
          errorMsg.innerHTML = `<div class="chat-bubble chat-bubble-error">Meow: Something went wrong!</div>`;
          messages.appendChild(errorMsg);
        }
      });

      input.addEventListener('keypress', e => e.key === 'Enter' && sendBtn.click());

      // Journal Carousel
      const carousel = document.getElementById('journal-carousel');
      const prevBtn = document.getElementById('prev-slide');
      const nextBtn = document.getElementById('next-slide');
      const dots = document.querySelectorAll('.carousel-dot');
      let currentSlide = 0;
      const totalSlides = 5;

      function updateCarousel() {
        carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, i) => {
          dot.classList.toggle('bg-primary', i === currentSlide);
          dot.classList.toggle('bg-base-300', i !== currentSlide);
        });
      }

      nextBtn.addEventListener('click', () => {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
      });

      prevBtn.addEventListener('click', () => {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
      });

      dots.forEach(dot => dot.addEventListener('click', () => {
        currentSlide = parseInt(dot.dataset.index);
        updateCarousel();
      }));

      // Swipe + Auto-play
      let startX = 0;
      carousel.addEventListener('touchstart', e => startX = e.changedTouches[0].screenX);
      carousel.addEventListener('touchend', e => {
        const endX = e.changedTouches[0].screenX;
        if (startX - endX > 50) nextBtn.click();
        if (endX - startX > 50) prevBtn.click();
      });

      setInterval(() => {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
      }, 5000);
    });
  </script>
</x-app-layout>
