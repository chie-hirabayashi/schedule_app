import { Calendar } from "@fullcalendar/core";
import jaLocale from "@fullcalendar/core/locales/ja";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

// htmlにidで埋め込み
const calendarEl = document.getElementById("calendar");

const calendar = new Calendar(calendarEl, {
    // 利用するパッケージ
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    // ナビゲーション
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
        // right: "dayGridMonth,dayGridWeek,dayGridDay,dayGrid,timeGridWeek,timeGridDay,timeGrid",
    },
    // 日本語化
    locales: jaLocale,
    locale: 'ja',

    // 日付表示の境界線時刻を設定(デフォルトは9時)
    nextDayThreshold: '00:00:00',

    // データを用意
    events: '/calendar/action',

    // 予定がない部分をクリック
    selectable: true,  // trueにしないと選択できない
    select: function (start, end, allDay) {
        // alert('selectのイベントです');
        createModal();
    },
    // 予定がある部分をクリック
    eventClick: function (event) {
        alert('eventClickのイベントです');
    },
    // 予定をドラッグ&ドロップ
    eventDrop: function (event, delta) {
        alert('eventDropのイベントです');
    },
    // 予定時刻のサイズ変更
    editable: true,  // trueにしないと変更できない
    eventResize: function (event, delta) {
        alert('eventResizeのイベントです');
    },
});

calendar.render();

const addButton = document.getElementById('add-button');

// キャンセルボタンの処理
const closeModalButton = document.getElementById('cancel-button');
closeModalButton.addEventListener('click', function() {
    addButton.classList.add('hidden');
    toggleModal();
});

function createModal() {
    document.getElementById('add-button').classList.remove('hidden');
    toggleModal();
}

function toggleModal() {
    document.getElementById('modal-id').classList.toggle('hidden');
    document.getElementById('modal-id').classList.toggle('flex');
    document.getElementById('modal-id-bg').classList.toggle('hidden');
    document.getElementById('modal-id-bg').classList.toggle('flex');
}
