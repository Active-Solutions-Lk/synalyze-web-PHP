<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="space-y-8">
  <!-- Header -->
  <div class="flex justify-between items-center pb-4 border-b border-gray-800">
    <div>
      <h2 class="text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
        <?= lucide_icon('BookOpen', 'text-[#00CED1] w-8 h-8') ?>
        Documentation Page Control Panel
      </h2>
      <p class="text-gray-400 text-sm mt-1">Manage all headings, onboarding steps, modules, settings, and troubleshooting accordion items dynamically.</p>
    </div>
  </div>

  <!-- Messages -->
  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-xl bg-green-950/40 border border-green-500/30 text-green-300 flex items-center gap-3 shadow-xl">
      <?= lucide_icon('CheckCircle', 'text-green-400 shrink-0 w-5 h-5') ?>
      <span class="text-sm font-medium"><?= e($_SESSION['success']) ?></span>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="p-4 rounded-xl bg-red-950/40 border border-red-500/30 text-red-300 flex items-center gap-3 shadow-xl">
      <?= lucide_icon('AlertCircle', 'text-red-400 shrink-0 w-5 h-5') ?>
      <span class="text-sm font-medium"><?= e($_SESSION['error']) ?></span>
      <?php unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <!-- Tabs Navigation -->
  <div class="flex border-b border-gray-800 bg-[#121212] p-1.5 rounded-xl gap-2 w-fit">
    <button onclick="switchTab('tab-general')" id="btn-tab-general" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-[#00CED1] bg-[#1a1a1a] transition-all flex items-center gap-2">
      <?= lucide_icon('Settings', 'w-4 h-4') ?>
      General settings
    </button>
    <button onclick="switchTab('tab-onboarding')" id="btn-tab-onboarding" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-gray-400 hover:text-white transition-all flex items-center gap-2">
      <?= lucide_icon('Cpu', 'w-4 h-4') ?>
      Onboarding & Syslog
    </button>
    <button onclick="switchTab('tab-modules')" id="btn-tab-modules" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-gray-400 hover:text-white transition-all flex items-center gap-2">
      <?= lucide_icon('Grid', 'w-4 h-4') ?>
      Core Modules
    </button>
    <button onclick="switchTab('tab-deployment')" id="btn-tab-deployment" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-gray-400 hover:text-white transition-all flex items-center gap-2">
      <?= lucide_icon('Server', 'w-4 h-4') ?>
      Deployment & Compliance
    </button>
    <button onclick="switchTab('tab-troubleshooting')" id="btn-tab-troubleshooting" class="tab-btn px-5 py-2.5 rounded-lg text-sm font-bold text-gray-400 hover:text-white transition-all flex items-center gap-2">
      <?= lucide_icon('HelpCircle', 'w-4 h-4') ?>
      Troubleshooting FAQ
    </button>
  </div>

  <!-- TAB 1: General Settings -->
  <div id="tab-general" class="tab-content space-y-6">
    <div class="bg-[#121212] border border-gray-800 rounded-2xl p-6 shadow-2xl">
      <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2 border-b border-gray-800 pb-3">
        <?= lucide_icon('Sliders', 'text-[#00CED1] w-5 h-5') ?>
        Main Page Headers & Section Introductions
      </h3>
      <form method="POST" action="<?= e(baseUrl('/admin/docs/page/update')) ?>" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Hero Eyebrow Text</label>
            <input type="text" name="eyebrowText" value="<?= e($docsPage['eyebrowText']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Hero Headline</label>
            <input type="text" name="headline" value="<?= e($docsPage['headline']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
        </div>

        <div>
          <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Hero Subheadline</label>
          <textarea name="subheadline" rows="2" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]"><?= e($docsPage['subheadline']) ?></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Getting Started Section Introduction</label>
            <textarea name="gettingStartedIntro" rows="4" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1] font-sans leading-relaxed"><?= e($docsPage['gettingStartedIntro']) ?></textarea>
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Onboarding Title</label>
            <input type="text" name="onboardingTitle" value="<?= e($docsPage['onboardingTitle']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1] mb-4">
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Syslog Integration Section Intro</label>
            <textarea name="integrationIntro" rows="2" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]"><?= e($docsPage['integrationIntro']) ?></textarea>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Syslog Setup Title</label>
            <input type="text" name="integrationSetupTitle" value="<?= e($docsPage['integrationSetupTitle']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Syslog Setup Subtitle</label>
            <input type="text" name="integrationSetupSubtitle" value="<?= e($docsPage['integrationSetupSubtitle']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
        </div>

        <div>
          <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Syslog Setup Note / Warning text</label>
          <textarea name="integrationSetupPortNote" rows="3" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1] font-mono text-xs"><?= e($docsPage['integrationSetupPortNote']) ?></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Core Modules Introduction</label>
            <textarea name="modulesIntro" rows="3" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]"><?= e($docsPage['modulesIntro']) ?></textarea>
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Deployment Details Introduction</label>
            <textarea name="deploymentIntro" rows="3" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]"><?= e($docsPage['deploymentIntro']) ?></textarea>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Compliance Title</label>
            <input type="text" name="complianceTitle" value="<?= e($docsPage['complianceTitle']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Help & Support Intro</label>
            <textarea name="supportIntro" rows="2" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]"><?= e($docsPage['supportIntro']) ?></textarea>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Support FAQ Accordion Title</label>
            <input type="text" name="supportFaqTitle" value="<?= e($docsPage['supportFaqTitle']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Support Contact card Title</label>
            <input type="text" name="supportContactTitle" value="<?= e($docsPage['supportContactTitle']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Support average response note</label>
            <input type="text" name="supportEmailNote" value="<?= e($docsPage['supportEmailNote']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Support Phone number</label>
            <input type="text" name="supportPhone" value="<?= e($docsPage['supportPhone']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Support Email Address</label>
            <input type="text" name="supportEmail" value="<?= e($docsPage['supportEmail']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Weekdays Support Hours</label>
            <input type="text" name="supportHoursWeekdays" value="<?= e($docsPage['supportHoursWeekdays']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Saturdays Support Hours</label>
            <input type="text" name="supportHoursSaturdays" value="<?= e($docsPage['supportHoursSaturdays']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
          <div>
            <label class="block text-xs uppercase font-extrabold text-gray-400 mb-2 tracking-wider">Sundays & Holidays Support Hours</label>
            <input type="text" name="supportHoursSundays" value="<?= e($docsPage['supportHoursSundays']) ?>" class="w-full bg-[#1A1A1A] border border-gray-800 rounded-xl p-3 text-white focus:outline-none focus:border-[#00CED1]">
          </div>
        </div>

        <div class="pt-4 border-t border-gray-800 flex justify-end">
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-3 px-8 rounded-xl transition-all shadow-lg flex items-center gap-2">
            <?= lucide_icon('Save', 'w-5 h-5') ?>
            Save Header Settings
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- TAB 2: Getting Started Onboarding & Syslog Fields -->
  <div id="tab-onboarding" class="tab-content space-y-8 hidden">
    <!-- Onboarding Steps -->
    <div class="bg-[#121212] border border-gray-800 rounded-2xl p-6 shadow-2xl">
      <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-3">
        <h3 class="text-xl font-bold text-white flex items-center gap-2">
          <?= lucide_icon('CheckSquare', 'text-[#00CED1] w-5 h-5') ?>
          Getting Started: Onboarding Steps List
        </h3>
        <button onclick="toggleForm('form-onboarding-add')" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-xl transition-all flex items-center gap-1.5 text-xs">
          <?= lucide_icon('Plus', 'w-4 h-4') ?>
          Add step
        </button>
      </div>

      <!-- Add Form -->
      <div id="form-onboarding-add" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 mb-6 hidden">
        <h4 class="text-white font-bold mb-4 text-sm">Add New Onboarding Step</h4>
        <form method="POST" action="<?= e(baseUrl('/admin/docs/onboarding/create')) ?>" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-xs text-gray-400 mb-1">Step Number</label>
              <input type="text" name="stepNumber" placeholder="e.g. 05" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
            </div>
            <div class="md:col-span-2">
              <label class="block text-xs text-gray-400 mb-1">Step Title</label>
              <input type="text" name="title" placeholder="e.g. Audit Logs" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
            </div>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Description</label>
            <input type="text" name="description" placeholder="Short description..." class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div class="flex justify-end gap-3 pt-2">
            <button type="button" onclick="toggleForm('form-onboarding-add')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
            <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Create Step</button>
          </div>
        </form>
      </div>

      <!-- List -->
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-800 text-gray-400 text-xs font-semibold uppercase tracking-wider">
              <th class="pb-3 w-16">Step</th>
              <th class="pb-3 w-48">Title</th>
              <th class="pb-3">Description</th>
              <th class="pb-3 text-right w-36">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800 text-sm text-gray-300">
            <?php foreach ($onboardingSteps as $step): ?>
              <tr>
                <td class="py-4 font-extrabold text-[#00CED1]"><?= e($step['stepNumber']) ?></td>
                <td class="py-4 font-bold text-white"><?= e($step['title']) ?></td>
                <td class="py-4"><?= e($step['description']) ?></td>
                <td class="py-4 text-right">
                  <div class="flex justify-end gap-2">
                    <button onclick="editOnboarding(<?= htmlspecialchars(json_encode($step)) ?>)" class="text-blue-400 hover:text-blue-300 transition-colors p-1" title="Edit">
                      <?= lucide_icon('Edit', 'w-4 h-4') ?>
                    </button>
                    <form method="POST" action="<?= e(baseUrl('/admin/docs/onboarding/delete')) ?>" onsubmit="return confirm('Delete this onboarding step?')" class="inline">
                      <input type="hidden" name="id" value="<?= $step['id'] ?>">
                      <button type="submit" class="text-red-400 hover:text-red-300 transition-colors p-1" title="Delete">
                        <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Edit Onboarding Step Modal/Form -->
    <div id="form-onboarding-edit" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 hidden">
      <h4 class="text-white font-bold mb-4 text-sm">Edit Onboarding Step</h4>
      <form method="POST" action="<?= e(baseUrl('/admin/docs/onboarding/update')) ?>" class="space-y-4">
        <input type="hidden" name="id" id="edit-onboarding-id">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs text-gray-400 mb-1">Step Number</label>
            <input type="text" name="stepNumber" id="edit-onboarding-stepNumber" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div class="md:col-span-2">
            <label class="block text-xs text-gray-400 mb-1">Step Title</label>
            <input type="text" name="title" id="edit-onboarding-title" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
        </div>
        <div>
          <label class="block text-xs text-gray-400 mb-1">Description</label>
          <input type="text" name="description" id="edit-onboarding-description" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
        </div>
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" onclick="closeEditForm('form-onboarding-edit')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Save Changes</button>
        </div>
      </form>
    </div>

    <!-- Syslog Configuration Fields -->
    <div class="bg-[#121212] border border-gray-800 rounded-2xl p-6 shadow-2xl">
      <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-3">
        <h3 class="text-xl font-bold text-white flex items-center gap-2">
          <?= lucide_icon('Terminal', 'text-[#00CED1] w-5 h-5') ?>
          Syslog Integration: Configuration Fields Table
        </h3>
        <button onclick="toggleForm('form-integration-add')" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-xl transition-all flex items-center gap-1.5 text-xs">
          <?= lucide_icon('Plus', 'w-4 h-4') ?>
          Add field
        </button>
      </div>

      <!-- Add Form -->
      <div id="form-integration-add" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 mb-6 hidden">
        <h4 class="text-white font-bold mb-4 text-sm">Add New Configuration Field</h4>
        <form method="POST" action="<?= e(baseUrl('/admin/docs/integration/create')) ?>" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs text-gray-400 mb-1">Field Name</label>
              <input type="text" name="fieldName" placeholder="e.g. Outbound port" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
            </div>
            <div>
              <label class="block text-xs text-gray-400 mb-1">Configuration Value</label>
              <input type="text" name="fieldValue" placeholder="e.g. 514" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
            </div>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Description</label>
            <input type="text" name="description" placeholder="Value explanation..." class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div class="flex justify-end gap-3 pt-2">
            <button type="button" onclick="toggleForm('form-integration-add')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
            <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Create Field</button>
          </div>
        </form>
      </div>

      <!-- List -->
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-800 text-gray-400 text-xs font-semibold uppercase tracking-wider">
              <th class="pb-3 w-48">Field Name</th>
              <th class="pb-3 w-64">Value</th>
              <th class="pb-3">Description</th>
              <th class="pb-3 text-right w-36">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800 text-sm text-gray-300">
            <?php foreach ($integrationFields as $field): ?>
              <tr>
                <td class="py-4 font-bold text-white"><?= e($field['fieldName']) ?></td>
                <td class="py-4 font-mono text-[#00CED1] text-xs"><?= e($field['fieldValue']) ?></td>
                <td class="py-4"><?= e($field['description']) ?></td>
                <td class="py-4 text-right">
                  <div class="flex justify-end gap-2">
                    <button onclick="editIntegration(<?= htmlspecialchars(json_encode($field)) ?>)" class="text-blue-400 hover:text-blue-300 transition-colors p-1" title="Edit">
                      <?= lucide_icon('Edit', 'w-4 h-4') ?>
                    </button>
                    <form method="POST" action="<?= e(baseUrl('/admin/docs/integration/delete')) ?>" onsubmit="return confirm('Delete this syslog configuration field?')" class="inline">
                      <input type="hidden" name="id" value="<?= $field['id'] ?>">
                      <button type="submit" class="text-red-400 hover:text-red-300 transition-colors p-1" title="Delete">
                        <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Edit Integration Modal/Form -->
    <div id="form-integration-edit" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 hidden">
      <h4 class="text-white font-bold mb-4 text-sm">Edit Configuration Field</h4>
      <form method="POST" action="<?= e(baseUrl('/admin/docs/integration/update')) ?>" class="space-y-4">
        <input type="hidden" name="id" id="edit-integration-id">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs text-gray-400 mb-1">Field Name</label>
            <input type="text" name="fieldName" id="edit-integration-fieldName" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Configuration Value</label>
            <input type="text" name="fieldValue" id="edit-integration-fieldValue" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
        </div>
        <div>
          <label class="block text-xs text-gray-400 mb-1">Description</label>
          <input type="text" name="description" id="edit-integration-description" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
        </div>
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" onclick="closeEditForm('form-integration-edit')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <!-- TAB 3: Core Modules -->
  <div id="tab-modules" class="tab-content space-y-6 hidden">
    <div class="bg-[#121212] border border-gray-800 rounded-2xl p-6 shadow-2xl">
      <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-3">
        <h3 class="text-xl font-bold text-white flex items-center gap-2">
          <?= lucide_icon('Grid', 'text-[#00CED1] w-5 h-5') ?>
          Core Modules: Grid Audit Cards
        </h3>
        <button onclick="toggleForm('form-module-add')" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-xl transition-all flex items-center gap-1.5 text-xs">
          <?= lucide_icon('Plus', 'w-4 h-4') ?>
          Add dynamic module
        </button>
      </div>

      <!-- Add Module Form -->
      <div id="form-module-add" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 mb-6 hidden">
        <h4 class="text-white font-bold mb-4 text-sm">Add New Core Module Card</h4>
        <form method="POST" action="<?= e(baseUrl('/admin/docs/module/create')) ?>" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-xs text-gray-400 mb-1">Lucide Icon name</label>
              <select name="iconName" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
                <option value="LayoutDashboard">LayoutDashboard</option>
                <option value="Search">Search</option>
                <option value="BarChart3">BarChart3</option>
                <option value="BellRing">BellRing</option>
                <option value="FileText">FileText</option>
                <option value="FolderLock">FolderLock</option>
                <option value="Shield">Shield</option>
                <option value="Server">Server</option>
                <option value="Users">Users</option>
                <option value="Key">Key</option>
                <option value="HelpCircle">HelpCircle</option>
                <option value="Settings">Settings</option>
                <option value="HardDrive">HardDrive</option>
                <option value="Cloud">Cloud</option>
              </select>
            </div>
            <div class="md:col-span-2">
              <label class="block text-xs text-gray-400 mb-1">Module Title</label>
              <input type="text" name="title" placeholder="e.g. Audit Logs" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
            </div>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Brief summary / subtitle</label>
            <input type="text" name="description" placeholder="e.g. The central command center..." class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Detailed Guide Bullets (One title-value pair per line, separated by colon: e.g. "Stats: Read values")</label>
            <textarea name="bulletPoints" rows="5" placeholder="Stats Overview: Check high-level cards at top&#10;Activity Trends: Use visual charts to spot surges" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm font-sans" required></textarea>
          </div>
          <div class="flex justify-end gap-3 pt-2">
            <button type="button" onclick="toggleForm('form-module-add')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
            <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Create Module</button>
          </div>
        </form>
      </div>

      <!-- Modules List Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($modules as $module): ?>
          <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-5 flex flex-col justify-between shadow-lg">
            <div>
              <div class="flex justify-between items-start gap-4 mb-3">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-lg bg-[#00CED1]/10 flex items-center justify-center text-[#00CED1] shrink-0">
                    <?= lucide_icon($module['iconName'], 'w-5 h-5') ?>
                  </div>
                  <h4 class="text-lg font-bold text-white leading-tight"><?= e($module['title']) ?></h4>
                </div>
                <div class="flex gap-1.5 shrink-0">
                  <button onclick="editModule(<?= htmlspecialchars(json_encode($module)) ?>)" class="text-gray-400 hover:text-white p-1.5 rounded-lg hover:bg-gray-800 transition-colors" title="Edit">
                    <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                  </button>
                  <form method="POST" action="<?= e(baseUrl('/admin/docs/module/delete')) ?>" onsubmit="return confirm('Delete this core module card?')" class="inline">
                    <input type="hidden" name="id" value="<?= $module['id'] ?>">
                    <button type="submit" class="text-red-400 hover:text-red-300 p-1.5 rounded-lg hover:bg-red-950/30 transition-colors" title="Delete">
                      <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                    </button>
                  </form>
                </div>
              </div>
              <p class="text-xs text-gray-400 mb-4"><?= e($module['description']) ?></p>
              
              <div class="border-t border-gray-800 pt-3">
                <p class="text-[10px] uppercase font-bold text-gray-500 mb-2">Detailed guide bullet points:</p>
                <ul class="space-y-2 text-xs text-gray-300 pl-4 list-disc">
                  <?php 
                  $bullets = explode("\n", $module['bulletPoints']);
                  foreach ($bullets as $b) {
                      if (trim($b)) {
                          $parts = explode(":", $b, 2);
                          if (count($parts) === 2) {
                              echo '<li><strong class="text-white">' . e(trim($parts[0])) . ':</strong> ' . e(trim($parts[1])) . '</li>';
                          } else {
                              echo '<li>' . e(trim($b)) . '</li>';
                          }
                      }
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Edit Module Modal/Form -->
    <div id="form-module-edit" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 hidden">
      <h4 class="text-white font-bold mb-4 text-sm">Edit Core Module</h4>
      <form method="POST" action="<?= e(baseUrl('/admin/docs/module/update')) ?>" class="space-y-4">
        <input type="hidden" name="id" id="edit-module-id">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs text-gray-400 mb-1">Lucide Icon name</label>
            <select name="iconName" id="edit-module-iconName" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
              <option value="LayoutDashboard">LayoutDashboard</option>
              <option value="Search">Search</option>
              <option value="BarChart3">BarChart3</option>
              <option value="BellRing">BellRing</option>
              <option value="FileText">FileText</option>
              <option value="FolderLock">FolderLock</option>
              <option value="Shield">Shield</option>
              <option value="Server">Server</option>
              <option value="Users">Users</option>
              <option value="Key">Key</option>
              <option value="HelpCircle">HelpCircle</option>
              <option value="Settings">Settings</option>
              <option value="HardDrive">HardDrive</option>
              <option value="Cloud">Cloud</option>
            </select>
          </div>
          <div class="md:col-span-2">
            <label class="block text-xs text-gray-400 mb-1">Module Title</label>
            <input type="text" name="title" id="edit-module-title" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
        </div>
        <div>
          <label class="block text-xs text-gray-400 mb-1">Brief summary / subtitle</label>
          <input type="text" name="description" id="edit-module-description" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
        </div>
        <div>
          <label class="block text-xs text-gray-400 mb-1">Detailed Guide Bullets (one title-description pair per line, e.g. "Title: description")</label>
          <textarea name="bulletPoints" id="edit-module-bulletPoints" rows="5" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm font-sans" required></textarea>
        </div>
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" onclick="closeEditForm('form-module-edit')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <!-- TAB 4: Deployment & Compliance -->
  <div id="tab-deployment" class="tab-content space-y-8 hidden">
    <!-- Deployment Options Cloud / On-Premise -->
    <div class="bg-[#121212] border border-gray-800 rounded-2xl p-6 shadow-2xl">
      <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-3">
        <h3 class="text-xl font-bold text-white flex items-center gap-2">
          <?= lucide_icon('Server', 'text-[#00CED1] w-5 h-5') ?>
          Deployment Details: Setup Models
        </h3>
        <button onclick="toggleForm('form-deployment-add')" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-xl transition-all flex items-center gap-1.5 text-xs">
          <?= lucide_icon('Plus', 'w-4 h-4') ?>
          Add setup option
        </button>
      </div>

      <!-- Add Deployment Form -->
      <div id="form-deployment-add" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 mb-6 hidden">
        <h4 class="text-white font-bold mb-4 text-sm">Add New Deployment Option Card</h4>
        <form method="POST" action="<?= e(baseUrl('/admin/docs/deployment/create')) ?>" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label class="block text-xs text-gray-400 mb-1">Badge Text (e.g. Recommended)</label>
              <input type="text" name="badge" placeholder="e.g. Enterprise" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
            </div>
            <div>
              <label class="block text-xs text-gray-400 mb-1">Lucide Icon name</label>
              <select name="iconName" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
                <option value="Cloud">Cloud</option>
                <option value="HardDrive">HardDrive</option>
                <option value="Server">Server</option>
                <option value="Shield">Shield</option>
              </select>
            </div>
            <div>
              <label class="block text-xs text-gray-400 mb-1">Option Title</label>
              <input type="text" name="title" placeholder="e.g. Hybrid Bases" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
            </div>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Brief summary / subtitle</label>
            <input type="text" name="description" placeholder="Option description..." class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Checkbox Bullet Points (one item per line)</label>
            <textarea name="bulletPoints" rows="4" placeholder="Auto-Scaling Infrastructure: details&#10;Zero Maintenance: details" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required></textarea>
          </div>
          <div class="flex justify-end gap-3 pt-2">
            <button type="button" onclick="toggleForm('form-deployment-add')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
            <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Create Deployment Option</button>
          </div>
        </form>
      </div>

      <!-- Deployment Option Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($deploymentOptions as $deploy): ?>
          <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-5 flex flex-col justify-between shadow-lg">
            <div>
              <div class="flex items-center justify-between mb-4 gap-4">
                <div class="flex items-center gap-3">
                  <span class="px-2.5 py-0.5 rounded text-[10px] uppercase font-bold text-white bg-[#00CED1]/25 border border-[#00CED1]/30"><?= e($deploy['badge']) ?></span>
                  <div class="text-[#00CED1]"><?= lucide_icon($deploy['iconName'], 'w-6 h-6') ?></div>
                </div>
                <div class="flex gap-1.5 shrink-0">
                  <button onclick="editDeployment(<?= htmlspecialchars(json_encode($deploy)) ?>)" class="text-gray-400 hover:text-white p-1.5 rounded-lg hover:bg-gray-800 transition-colors" title="Edit">
                    <?= lucide_icon('Edit2', 'w-4 h-4') ?>
                  </button>
                  <form method="POST" action="<?= e(baseUrl('/admin/docs/deployment/delete')) ?>" onsubmit="return confirm('Delete this deployment option card?')" class="inline">
                    <input type="hidden" name="id" value="<?= $deploy['id'] ?>">
                    <button type="submit" class="text-red-400 hover:text-red-300 p-1.5 rounded-lg hover:bg-red-950/30 transition-colors" title="Delete">
                      <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                    </button>
                  </form>
                </div>
              </div>
              <h4 class="text-lg font-bold text-white mb-2"><?= e($deploy['title']) ?></h4>
              <p class="text-xs text-gray-400 mb-4"><?= e($deploy['description']) ?></p>

              <div class="border-t border-gray-800 pt-3">
                <p class="text-[10px] uppercase font-bold text-gray-500 mb-2">Checkmark bullet points:</p>
                <ul class="space-y-2 text-xs text-gray-300 pl-4 list-disc">
                  <?php 
                  $bullets = explode("\n", $deploy['bulletPoints']);
                  foreach ($bullets as $b) {
                      if (trim($b)) {
                          $parts = explode(":", $b, 2);
                          if (count($parts) === 2) {
                              echo '<li><strong class="text-white">' . e(trim($parts[0])) . ':</strong> ' . e(trim($parts[1])) . '</li>';
                          } else {
                              echo '<li>' . e(trim($b)) . '</li>';
                          }
                      }
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Edit Deployment Form -->
    <div id="form-deployment-edit" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 hidden">
      <h4 class="text-white font-bold mb-4 text-sm">Edit Deployment Option</h4>
      <form method="POST" action="<?= e(baseUrl('/admin/docs/deployment/update')) ?>" class="space-y-4">
        <input type="hidden" name="id" id="edit-deployment-id">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs text-gray-400 mb-1">Badge Text</label>
            <input type="text" name="badge" id="edit-deployment-badge" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Lucide Icon name</label>
            <select name="iconName" id="edit-deployment-iconName" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
              <option value="Cloud">Cloud</option>
              <option value="HardDrive">HardDrive</option>
              <option value="Server">Server</option>
              <option value="Shield">Shield</option>
            </select>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Option Title</label>
            <input type="text" name="title" id="edit-deployment-title" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
        </div>
        <div>
          <label class="block text-xs text-gray-400 mb-1">Brief summary / subtitle</label>
          <input type="text" name="description" id="edit-deployment-description" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
        </div>
        <div>
          <label class="block text-xs text-gray-400 mb-1">Checkbox Bullet Points (one item per line)</label>
          <textarea name="bulletPoints" id="edit-deployment-bulletPoints" rows="4" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required></textarea>
        </div>
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" onclick="closeEditForm('form-deployment-edit')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Save Changes</button>
        </div>
      </form>
    </div>

    <!-- Standards & Compliance Items -->
    <div class="bg-[#121212] border border-gray-800 rounded-2xl p-6 shadow-2xl">
      <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-3">
        <h3 class="text-xl font-bold text-white flex items-center gap-2">
          <?= lucide_icon('ShieldAlert', 'text-[#00CED1] w-5 h-5') ?>
          Standards & Compliance Certifications
        </h3>
        <button onclick="toggleForm('form-compliance-add')" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-xl transition-all flex items-center gap-1.5 text-xs">
          <?= lucide_icon('Plus', 'w-4 h-4') ?>
          Add standard
        </button>
      </div>

      <!-- Add Compliance Form -->
      <div id="form-compliance-add" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 mb-6 hidden">
        <h4 class="text-white font-bold mb-4 text-sm">Add Compliance Standard</h4>
        <form method="POST" action="<?= e(baseUrl('/admin/docs/compliance/create')) ?>" class="space-y-4">
          <div>
            <label class="block text-xs text-gray-400 mb-1">Standard Title</label>
            <input type="text" name="title" placeholder="e.g. HIPAA Compliant" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Description / Summary text</label>
            <input type="text" name="description" placeholder="Standard details..." class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div class="flex justify-end gap-3 pt-2">
            <button type="button" onclick="toggleForm('form-compliance-add')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
            <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Create Compliance Item</button>
          </div>
        </form>
      </div>

      <!-- Compliance list table -->
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-gray-800 text-gray-400 text-xs font-semibold uppercase tracking-wider">
              <th class="pb-3 w-64">Standard Title</th>
              <th class="pb-3">Description / Summary Details</th>
              <th class="pb-3 text-right w-36">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800 text-sm text-gray-300">
            <?php foreach ($complianceItems as $comp): ?>
              <tr>
                <td class="py-4 font-bold text-white"><?= e($comp['title']) ?></td>
                <td class="py-4 text-xs text-gray-400"><?= e($comp['description']) ?></td>
                <td class="py-4 text-right">
                  <div class="flex justify-end gap-2">
                    <button onclick="editCompliance(<?= htmlspecialchars(json_encode($comp)) ?>)" class="text-blue-400 hover:text-blue-300 transition-colors p-1" title="Edit">
                      <?= lucide_icon('Edit', 'w-4 h-4') ?>
                    </button>
                    <form method="POST" action="<?= e(baseUrl('/admin/docs/compliance/delete')) ?>" onsubmit="return confirm('Delete this compliance standard item?')" class="inline">
                      <input type="hidden" name="id" value="<?= $comp['id'] ?>">
                      <button type="submit" class="text-red-400 hover:text-red-300 transition-colors p-1" title="Delete">
                        <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Edit Compliance Form -->
    <div id="form-compliance-edit" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 hidden">
      <h4 class="text-white font-bold mb-4 text-sm">Edit Compliance Item</h4>
      <form method="POST" action="<?= e(baseUrl('/admin/docs/compliance/update')) ?>" class="space-y-4">
        <input type="hidden" name="id" id="edit-compliance-id">
        <div>
          <label class="block text-xs text-gray-400 mb-1">Standard Title</label>
          <input type="text" name="title" id="edit-compliance-title" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
        </div>
        <div>
          <label class="block text-xs text-gray-400 mb-1">Description / Summary text</label>
          <input type="text" name="description" id="edit-compliance-description" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
        </div>
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" onclick="closeEditForm('form-compliance-edit')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <!-- TAB 5: Troubleshooting FAQ accordion -->
  <div id="tab-troubleshooting" class="tab-content space-y-6 hidden">
    <div class="bg-[#121212] border border-gray-800 rounded-2xl p-6 shadow-2xl">
      <div class="flex justify-between items-center mb-6 border-b border-gray-800 pb-3">
        <h3 class="text-xl font-bold text-white flex items-center gap-2">
          <?= lucide_icon('HelpCircle', 'text-[#00CED1] w-5 h-5') ?>
          Troubleshooting FAQ Accordion Items
        </h3>
        <button onclick="toggleForm('form-faq-add')" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-xl transition-all flex items-center gap-1.5 text-xs">
          <?= lucide_icon('Plus', 'w-4 h-4') ?>
          Add FAQ
        </button>
      </div>

      <!-- Add FAQ Form -->
      <div id="form-faq-add" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 mb-6 hidden">
        <h4 class="text-white font-bold mb-4 text-sm">Add New Dynamic FAQ</h4>
        <form method="POST" action="<?= e(baseUrl('/admin/docs/faq/create')) ?>" class="space-y-4">
          <div>
            <label class="block text-xs text-gray-400 mb-1">Troubleshooting Question</label>
            <input type="text" name="question" placeholder="e.g. Outbound syslog connections timeout?" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
          </div>
          <div>
            <label class="block text-xs text-gray-400 mb-1">Troubleshooting Answer details</label>
            <textarea name="answer" rows="3" placeholder="Provide details to configure firewall egress or syslog configurations..." class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required></textarea>
          </div>
          <div class="flex justify-end gap-3 pt-2">
            <button type="button" onclick="toggleForm('form-faq-add')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
            <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Create FAQ Item</button>
          </div>
        </form>
      </div>

      <!-- List -->
      <div class="space-y-4">
        <?php foreach ($faqs as $faq): ?>
          <div class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-5 shadow-md flex justify-between items-start gap-4">
            <div class="flex-grow">
              <h4 class="text-sm font-bold text-white mb-2 leading-snug"><?= e($faq['question']) ?></h4>
              <p class="text-xs text-gray-400 leading-relaxed"><?= e($faq['answer']) ?></p>
            </div>
            <div class="flex gap-1.5 shrink-0">
              <button onclick="editFaq(<?= htmlspecialchars(json_encode($faq)) ?>)" class="text-gray-400 hover:text-white p-1.5 rounded-lg hover:bg-gray-800 transition-colors" title="Edit">
                <?= lucide_icon('Edit2', 'w-4 h-4') ?>
              </button>
              <form method="POST" action="<?= e(baseUrl('/admin/docs/faq/delete')) ?>" onsubmit="return confirm('Delete this FAQ accordion item?')" class="inline">
                <input type="hidden" name="id" value="<?= $faq['id'] ?>">
                <button type="submit" class="text-red-400 hover:text-red-300 p-1.5 rounded-lg hover:bg-red-950/30 transition-colors" title="Delete">
                  <?= lucide_icon('Trash2', 'w-4 h-4') ?>
                </button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Edit FAQ Form -->
    <div id="form-faq-edit" class="bg-[#1A1A1A] p-5 rounded-xl border border-gray-800 hidden">
      <h4 class="text-white font-bold mb-4 text-sm">Edit FAQ accordion</h4>
      <form method="POST" action="<?= e(baseUrl('/admin/docs/faq/update')) ?>" class="space-y-4">
        <input type="hidden" name="id" id="edit-faq-id">
        <div>
          <label class="block text-xs text-gray-400 mb-1">Troubleshooting Question</label>
          <input type="text" name="question" id="edit-faq-question" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required>
        </div>
        <div>
          <label class="block text-xs text-gray-400 mb-1">Troubleshooting Answer details</label>
          <textarea name="answer" id="edit-faq-answer" rows="3" class="w-full bg-[#121212] border border-gray-800 rounded-lg p-2.5 text-white focus:outline-none text-sm" required></textarea>
        </div>
        <div class="flex justify-end gap-3 pt-2">
          <button type="button" onclick="closeEditForm('form-faq-edit')" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold py-2 px-4 rounded-lg text-xs">Cancel</button>
          <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-2 px-4 rounded-lg text-xs">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Dynamic interactive tabs & modal JS script -->
<script>
function switchTab(tabId) {
  // Hide all contents
  document.querySelectorAll('.tab-content').forEach(el => {
    el.classList.add('hidden');
  });
  
  // Deactivate all button styles
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.classList.remove('text-[#00CED1]', 'bg-[#1a1a1a]');
    btn.classList.add('text-gray-400', 'hover:text-white');
  });

  // Activate chosen content
  document.getElementById(tabId).classList.remove('hidden');
  
  // Activate button style
  const activeBtn = document.getElementById('btn-' + tabId);
  activeBtn.classList.remove('text-gray-400', 'hover:text-white');
  activeBtn.classList.add('text-[#00CED1]', 'bg-[#1a1a1a]');
  
  // Save current active tab in session storage to stay on same tab after POST submits
  sessionStorage.setItem('docs_active_tab', tabId);
}

function toggleForm(id) {
  const form = document.getElementById(id);
  form.classList.toggle('hidden');
  if (!form.classList.contains('hidden')) {
    form.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
}

function closeEditForm(id) {
  document.getElementById(id).classList.add('hidden');
}

// Edit actions helpers
function editOnboarding(stepObj) {
  document.getElementById('edit-onboarding-id').value = stepObj.id;
  document.getElementById('edit-onboarding-stepNumber').value = stepObj.stepNumber;
  document.getElementById('edit-onboarding-title').value = stepObj.title;
  document.getElementById('edit-onboarding-description').value = stepObj.description;
  
  const form = document.getElementById('form-onboarding-edit');
  form.classList.remove('hidden');
  form.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function editIntegration(fieldObj) {
  document.getElementById('edit-integration-id').value = fieldObj.id;
  document.getElementById('edit-integration-fieldName').value = fieldObj.fieldName;
  document.getElementById('edit-integration-fieldValue').value = fieldObj.fieldValue;
  document.getElementById('edit-integration-description').value = fieldObj.description;
  
  const form = document.getElementById('form-integration-edit');
  form.classList.remove('hidden');
  form.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function editModule(moduleObj) {
  document.getElementById('edit-module-id').value = moduleObj.id;
  document.getElementById('edit-module-iconName').value = moduleObj.iconName;
  document.getElementById('edit-module-title').value = moduleObj.title;
  document.getElementById('edit-module-description').value = moduleObj.description;
  document.getElementById('edit-module-bulletPoints').value = moduleObj.bulletPoints;
  
  const form = document.getElementById('form-module-edit');
  form.classList.remove('hidden');
  form.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function editDeployment(deployObj) {
  document.getElementById('edit-deployment-id').value = deployObj.id;
  document.getElementById('edit-deployment-badge').value = deployObj.badge;
  document.getElementById('edit-deployment-iconName').value = deployObj.iconName;
  document.getElementById('edit-deployment-title').value = deployObj.title;
  document.getElementById('edit-deployment-description').value = deployObj.description;
  document.getElementById('edit-deployment-bulletPoints').value = deployObj.bulletPoints;
  
  const form = document.getElementById('form-deployment-edit');
  form.classList.remove('hidden');
  form.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function editCompliance(compObj) {
  document.getElementById('edit-compliance-id').value = compObj.id;
  document.getElementById('edit-compliance-title').value = compObj.title;
  document.getElementById('edit-compliance-description').value = compObj.description;
  
  const form = document.getElementById('form-compliance-edit');
  form.classList.remove('hidden');
  form.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function editFaq(faqObj) {
  document.getElementById('edit-faq-id').value = faqObj.id;
  document.getElementById('edit-faq-question').value = faqObj.question;
  document.getElementById('edit-faq-answer').value = faqObj.answer;
  
  const form = document.getElementById('form-faq-edit');
  form.classList.remove('hidden');
  form.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Restore active tab on load
document.addEventListener('DOMContentLoaded', () => {
  const activeTab = sessionStorage.getItem('docs_active_tab');
  if (activeTab && document.getElementById(activeTab)) {
    switchTab(activeTab);
  }
});
</script>
