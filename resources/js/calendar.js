import { Calendar } from "@fullcalendar/core";
import jaLocale from "@fullcalendar/core/locales/ja";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";

// htmlにidで埋め込み
const calendarEl = document.getElementById("calendar");

const calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, timeGridPlugin],
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
    events: [
        {
            'title': 'スパルタキャンプ',
            'start': '2022-10-01 08:30',
            'end': '2022-10-01 18:30'
        },
        {
            'title': 'スパルタキャンプ',
            'start': '2022-10-02 08:30',
            'end': '2022-10-02 18:30'
        },
        {
            'title': 'スパルタキャンプ',
            'start': '2022-10-08 08:30',
            'end': '2022-10-08 18:30'
        },
        {
            'title': 'スパルタキャンプ',
            'start': '2022-10-09 08:30',
            'end': '2022-10-09 18:30'
        },
        {
            'title': '山賊まつり',
            'start': '2022-10-08',
            'end': '2022-10-10'
        }
    ],
});

calendar.render();
