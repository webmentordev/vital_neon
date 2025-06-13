<div class="h-screen w-full flex p-3" x-data="{ 
    activeTab: 0,
    tabs: [
        {
            id: 0,
            text: 'The Ways',
            font: 'colon-mono',
            fontSize: 40,
            width: 19,
            height: 4,
            price: 200
        }
    ],
    addTab() {
        const newId = this.tabs.length > 0 ? Math.max(...this.tabs.map(tab => tab.id)) + 1 : 0;
                    this.tabs.push({
            id: newId,
            text: 'New Sign',
            font: 'colon-mono',
            fontSize: 40,
            width: 10,
            height: 3,
            price: 150
        });
        this.activeTab = newId;
    },
    removeTab(tabId) {
        if (this.tabs.length <= 1) {
            return; // Don't remove if it's the last tab
        }
        const index = this.tabs.findIndex(tab => tab.id === tabId);
        if (index !== -1) {
            this.tabs.splice(index, 1);
            if (this.activeTab === tabId) {
                this.activeTab = this.tabs[0].id;
            }
        }
    },
    getActiveTab() {
        return this.tabs.find(tab => tab.id === this.activeTab);
    }
}">
    <div class="w-full h-full bg-light rounded-lg p-4">
        <div class="mt-3 m-auto grid grid-cols-3 gap-3">
            <template x-for="tab in tabs" :key="tab . id">
                <div class="tab-1 max-w-[430px] h-[160px] border border-white/10 flex items-center justify-center relative"
                    :class="tab . id === activeTab ? 'border-blue-500 border-2' : 'border-white/10'"
                    @click="activeTab = tab.id">
                    <span :class="tab . font" class="text-white -translate-y-3" :style="`font-size: ${tab . fontSize}px; text-shadow:
                        rgba(255, 255, 255, 0.7) 0px 0px 5px,
                        rgba(255, 255, 255, 0.7) 0px 0px 5px,
                        rgba(255, 255, 255, 0.7) 0px 0px 8px,
                        rgba(255, 255, 255, 0.7) 0px 0px 12px,
                        rgba(255, 255, 255, 0.7) 0px 0px 16px,
                        rgba(255, 255, 255, 0.7) 0px 0px 20px,
                        rgb(255, 255, 255) 0px 0px 30px;`"
                        x-text="tab.text"></span>
                    <div class="absolute bottom-0 left-0 w-full">
                        <div class="w-full flex justify-between items-end">
                            <span class="bg-black py-1 px-3 text-white text-[13px] capitalize"
                                x-text="tab.font.replace('colon-', '')"></span>
                            <div class="flex items-end">
                                <div class="flex flex-col py-[2px] px-3 h-[28px] bg-white mr-2">
                                    <strong class="text-[9px]" x-text="`Width: ${tab.width} inches`"></strong>
                                    <strong class="text-[9px]" x-text="`Height: ${tab.height} inches`"></strong>
                                </div>
                                <strong class="py-1 px-3 text-[12px] h-[28px] bg-white"
                                    x-text="`USD ${tab.price}`"></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <div class="w-full max-w-xl p-3 overflow-y-scroll">
        <button @click="addTab()" class="flex items-center border border-white/20 p-2 px-4 rounded-md">
            <strong class="mr-2 text-white">Add new design</strong>
            <img src="https://api.iconify.design/pajamas:file-addition.svg?color=%2336cadd" width="25px">
        </button>
        <div class="grid grid-cols-6 gap-1 my-4 space-x-2">
            <template x-for="tab in tabs" :key="tab . id">
                <button @click="activeTab = tab.id" class="py-2 px-4 font-semibold rounded-md transition-colors"
                    :class="activeTab === tab . id ? 'bg-white text-black' : 'bg-gray-700 text-white'">
                    <span x-text="`Tab#${tab.id + 1}`"></span>
                </button>
            </template>
        </div>
        <div class="flex flex-col bg-light p-3 rounded-lg">
            <div class="flex flex-col mb-3" x-show="getActiveTab()">
                <div class="mb-2">
                    <label class="block text-white text-sm mb-1">Text</label>
                    <textarea x-model="getActiveTab().text" class="w-full p-2 rounded" rows="2"></textarea>
                </div>
                <div class="mb-2">
                    <label class="block text-white text-sm mb-1">Font Size (px)</label>
                    <x-preview-input type="number" x-model.number="getActiveTab().fontSize" step="1"
                        class="w-full p-2 rounded" placeholder="Font Size" />
                </div>
                <div class="mb-2">
                    <label class="block text-white text-sm mb-1">Width (inches)</label>
                    <x-preview-input type="number" x-model.number="getActiveTab().width" step="0.01"
                        class="w-full p-2 rounded" placeholder="Width" />
                </div>
                <div class="mb-2">
                    <label class="block text-white text-sm mb-1">Height (inches)</label>
                    <x-preview-input type="number" x-model.number="getActiveTab().height" step="0.01"
                        class="w-full p-2 rounded" placeholder="Height" />
                </div>
                <div class="mb-2">
                    <label class="block text-white text-sm mb-1">Price ($)</label>
                    <x-preview-input type="number" x-model.number="getActiveTab().price" step="0.01"
                        class="w-full p-2 rounded" placeholder="Price in $" />
                </div>
            </div>
            <div
                class="grid grid-cols-3 gap-2 1210px:grid-cols-2 870px:grid-cols-3 575px:grid-cols-2 475px:grid-cols-1">
                @foreach ($fonts as $fonty)
                    <div @click="getActiveTab().font = '{{ $fonty }}'"
                        class="p-3 cursor-pointer text-white rounded-lg text-center border text-lg capitalize {{ $fonty }}"
                        :class="getActiveTab() . font === '{{ $fonty }}' ? 'border-blue-500 border-2' : 'border-white/20'">
                        {{ $fonty }}
                    </div>
                @endforeach
            </div>
            <button @click="removeTab(activeTab)"
                class="flex items-center border border-white/20 p-2 px-4 rounded-md w-fit mt-3">
                <strong class="mr-2 text-white">Remove Design</strong>
                <img src="https://api.iconify.design/material-symbols:delete-outline-rounded.svg?color=%23f31637"
                    width="25px">
            </button>
        </div>
    </div>
</div>