<div>
    @if($showModal)
    <!-- QRコード表示ポップアップ -->
    <div class="fixed z-10 inset-0 overflow-y-auto">
        <!-- 中略：QRコードを表示するためのコンテンツ -->
        {!! QrCode::size(200)->generate(route('qrReservation', ['id' => $reservationId])) !!}
        <button wire:click="closeModal" type="button" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            閉じる
        </button>
    </div>
    @endif
</div>