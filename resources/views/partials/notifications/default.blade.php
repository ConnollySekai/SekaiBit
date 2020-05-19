<div class="notification panel">
    <div class="notification__icon notification__icon--{{ $type }}">
        @svg("public/images/$type",'fill-white h-6 w-6')
    </div>
    <div class="notification__message">{{ $message }}</div>
    <div class="notification__close" onclick="document.querySelector('.notification').outerHTML=''">
        @svg('public/images/close','fill-current text-gray-300 h-4 w-4 hover:text-gray-400')
    </div>
</div>