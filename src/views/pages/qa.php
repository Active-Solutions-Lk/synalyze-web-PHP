<style>
/* Custom FAQ Section Design */
.faq-categories-container {
  display: flex;
  flex-direction: column;
  gap: 48px;
}

.faq-category-title {
  font-size: 1.875rem; /* 30px */
  font-weight: 700;
  color: #ffffff;
  letter-spacing: -0.02em;
  margin-bottom: 24px;
  text-align: left;
}

.faq-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.faq-card {
  background-color: #111d2a; /* Slate/navy blue matching the design image */
  border: 1px solid rgba(255, 255, 255, 0.02);
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.faq-card:hover {
  background-color: #142232;
  border-color: rgba(var(--accent-rgb), 0.25);
  transform: translateY(-1px);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
}

.faq-summary {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 24px 28px;
  cursor: pointer;
  user-select: none;
  list-style: none;
}

.faq-summary::-webkit-details-marker {
  display: none;
}

.faq-question-wrap {
  display: flex;
  align-items: center;
  gap: 16px;
  color: #ffffff;
  flex: 1;
}

.faq-icon-left {
  width: 24px;
  height: 24px;
  color: #ffffff;
  opacity: 0.9;
  flex-shrink: 0;
}

.faq-question-text {
  font-size: 1.2rem; /* ~19px */
  font-weight: 600;
  letter-spacing: -0.01em;
  line-height: 1.4;
}

.faq-chevron {
  width: 24px;
  height: 24px;
  color: var(--accent-color);
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  flex-shrink: 0;
  margin-left: 12px;
}

/* Open states */
details[open] {
  background-color: #111d2a;
}

details[open] .faq-chevron {
  transform: rotate(180deg);
}

.faq-answer-container {
  padding: 0 28px 28px 28px;
}

.faq-answer-text {
  margin-left: 40px; /* Align text perfectly past the 24px icon + 16px gap */
  color: #94a3b8; /* Soft blue-slate text */
  font-size: 0.95rem; /* ~15px */
  line-height: 1.6;
  font-weight: 400;
}

@media (max-width: 768px) {
  .faq-categories-container {
    gap: 36px;
  }
  
  .faq-category-title {
    font-size: 1.5rem;
    margin-bottom: 16px;
  }
  
  .faq-summary {
    padding: 18px 20px;
  }
  
  .faq-question-text {
    font-size: 1.05rem;
  }
  
  .faq-icon-left {
    width: 20px;
    height: 20px;
  }
  
  .faq-chevron {
    width: 20px;
    height: 20px;
  }
  
  .faq-answer-container {
    padding: 0 20px 20px 20px;
  }
  
  .faq-answer-text {
    margin-left: 0; /* Stack layout naturally on mobile devices */
    font-size: 0.9rem;
    padding-top: 4px;
  }
  
  .faq-question-wrap {
    gap: 12px;
  }
}
</style>

<div class="relative font-sans pt-28 md:pt-48 pb-0">
  <!-- Top glow backdrop -->
  <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(circle at top, rgba(var(--accent-rgb), 0.1) 0%, transparent 50%);"></div>

  <div class="container relative z-10 mx-auto px-6 max-w-5xl">
    <!-- Header -->
    <div class="text-center mb-20">
      <h1 class="text-3xl sm:text-5xl md:text-6xl font-semibold lg:text-7xl text-white mb-6 tracking-tight">
        Frequently Asked Questions
      </h1>
      <p class="text-base md:text-xl text-gray-400 max-w-3xl mx-auto leading-relaxed">
        Here are some common questions about SYNALYZE. If you can't find the answer you're looking for, please visit our
        <a href="<?= e(baseUrl('/support')) ?>" class="text-accent hover:underline font-medium transition-colors">Support Center</a>
        or
        <a href="<?= e(baseUrl('/contact')) ?>" class="text-accent hover:underline font-medium transition-colors">Contact Us</a>
      </p>
    </div>

    <!-- FAQ Categories & Items List -->
    <div class="faq-categories-container">
      <?php foreach ($categories as $category): ?>
        <div>
          <h2 class="faq-category-title">
            <?= e($category['name']) ?>
          </h2>
          
          <div class="faq-list">
            <?php if (empty($category['items'])): ?>
              <div class="faq-card p-6">
                <p class="text-gray-500 italic">No questions in this category yet.</p>
              </div>
            <?php else: ?>
              <?php foreach ($category['items'] as $item): ?>
                <details class="faq-card group" <?= $item === reset($category['items']) && $category === reset($categories) ? 'closed' : '' ?>>
                  <summary class="faq-summary">
                    <div class="faq-question-wrap">
                      <?= lucide_icon('HelpCircle', 'faq-icon-left', '1.5') ?>
                      <span class="faq-question-text"><?= e($item['question']) ?></span>
                    </div>
                    <?= lucide_icon('ChevronDown', 'faq-chevron', '2.5') ?>
                  </summary>
                  <div class="faq-answer-container">
                    <div class="faq-answer-text">
                      <?= e($item['answer']) ?>
                    </div>
                  </div>
                </details>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="h-[1px] w-full bg-white mt-20"></div>

  </div>

  <!-- Bottom transition gradient -->
  <div class="h-96 bg-gradient-to-b from-transparent via-[#16171B] via-40% to-[#111111] relative z-10 w-full pointer-events-none -mt-48"></div>
</div>
