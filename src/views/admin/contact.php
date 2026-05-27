<div class="space-y-6 pb-10">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-white">Contact Page Content</h2>
  </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="p-4 rounded-md bg-green-900/50 border border-green-500 text-green-300 mb-6">
      <?= e($_SESSION['success']) ?>
      <?php unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="<?= e(baseUrl('/admin/contact/update')) ?>" class="bg-[#1A1A1A] border border-gray-800 rounded-xl p-6 space-y-8">
    
    <!-- Hero -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Hero Section</h3>
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Title</label>
          <input type="text" name="heroTitle" value="<?= e($pageData['heroTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Description</label>
          <textarea name="heroDescription" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white h-20"><?= e($pageData['heroDescription']) ?></textarea>
        </div>
      </div>
    </div>

    <!-- Phone -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Phone Details</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Section Title</label>
          <input type="text" name="phoneTitle" value="<?= e($pageData['phoneTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div></div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Sales Label</label>
          <input type="text" name="phoneSalesLabel" value="<?= e($pageData['phoneSalesLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Sales Number</label>
          <input type="text" name="phoneSalesValue" value="<?= e($pageData['phoneSalesValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Support Label</label>
          <input type="text" name="phoneSupportLabel" value="<?= e($pageData['phoneSupportLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Support Number</label>
          <input type="text" name="phoneSupportValue" value="<?= e($pageData['phoneSupportValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
      </div>
    </div>

    <!-- Email -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Email Details</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-400 mb-1">Section Title</label>
          <input type="text" name="emailTitle" value="<?= e($pageData['emailTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Sales Label</label>
          <input type="text" name="emailSalesLabel" value="<?= e($pageData['emailSalesLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Sales Email</label>
          <input type="text" name="emailSalesValue" value="<?= e($pageData['emailSalesValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Support Label</label>
          <input type="text" name="emailSupportLabel" value="<?= e($pageData['emailSupportLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Support Email</label>
          <input type="text" name="emailSupportValue" value="<?= e($pageData['emailSupportValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">General Label</label>
          <input type="text" name="emailGeneralLabel" value="<?= e($pageData['emailGeneralLabel']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">General Email</label>
          <input type="text" name="emailGeneralValue" value="<?= e($pageData['emailGeneralValue']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
      </div>
    </div>

    <!-- Address -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Address Details</h3>
      <div class="grid grid-cols-1 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Section Title</label>
          <input type="text" name="addressTitle" value="<?= e($pageData['addressTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div><input type="text" name="addressLine1" value="<?= e($pageData['addressLine1']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 1"></div>
        <div><input type="text" name="addressLine2" value="<?= e($pageData['addressLine2']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 2"></div>
        <div><input type="text" name="addressLine3" value="<?= e($pageData['addressLine3']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 3"></div>
        <div><input type="text" name="addressLine4" value="<?= e($pageData['addressLine4']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 4"></div>
        <div><input type="text" name="addressLine5" value="<?= e($pageData['addressLine5']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white" placeholder="Line 5"></div>
      </div>
    </div>

    <!-- Form & Map -->
    <div class="space-y-4">
      <h3 class="text-xl font-bold text-[#00CED1] border-b border-gray-700 pb-2">Other</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Form Title</label>
          <input type="text" name="formTitle" value="<?= e($pageData['formTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Form Description</label>
          <input type="text" name="formDescription" value="<?= e($pageData['formDescription']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-400 mb-1">Location Title</label>
          <input type="text" name="locationTitle" value="<?= e($pageData['locationTitle']) ?>" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white">
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-400 mb-1">Map Embed URL (src)</label>
          <textarea name="mapEmbedUrl" class="w-full bg-[#242424] border border-gray-700 rounded-md p-2 text-white h-20"><?= e($pageData['mapEmbedUrl']) ?></textarea>
        </div>
      </div>
    </div>

    <div class="pt-4 border-t border-gray-800">
      <button type="submit" class="bg-[#00CED1] hover:bg-[#00a3a6] text-black font-bold py-3 px-8 rounded-md transition-colors text-lg">
        Save Contact Page
      </button>
    </div>
  </form>
</div>
