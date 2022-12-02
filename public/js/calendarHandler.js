const calendarHandler = {
    singleDay:
        "<div style='margin:1.5%; padding:22px; border:1px solid #cbcbcb; background:#e1e1e1; border-radius:15px' class='&active& col-2 singleDay' data-date='&day&'>&day& <br><br> &action& </div>",
    btnAccess: "<button class='btn btn-danger openPopup'>Details</button>",
    singleHour:
        "<div class='w-100 singleHour hourItem' data-hour='&hour&'>&hour&</div>",
    init: function () {
        today = new Date().getDate();
        month = new Date().getMonth();
        year = new Date().getFullYear();
        days = daysInMonth(month, year);
        for (i = 1; i <= days; i++) {
            day = calendarHandler.singleDay;
            if (today >= i) {
                day = day.replace("&active&", "disable");
                day = day.replace("&action&", "");
            } else {
                day = day.replace("&active&", "active");
                day = day.replace("&action&", calendarHandler.btnAccess);
            }
            day = day.replaceAll(
                "&day&",
                formatData(new Date(year, month, i)) + " " + monthNames[month]
            );
            $(".calendarConsult .days").append(day);
        }
        $(".calendarConsult .month").text(monthNames[month]);
        $(".openPopup").on("click", function () {
            date = $(this).closest(".singleDay").data("date");
            let url = "/api/allschedules";
            $.post(url, { date: date }, function (response) {
                if (response.status == "ok") {
                    let allDates = response.data;
                    calendarHandler.popup(date, allDates);
                }
            });
        });
    },
    popup: function (date, allDates) {
        $(".popupLayout").hide();
        $(".popupLayout .hours").html("");
        $(".popupLayout .date").text(date);
        $(".popupLayout").show();
        $(".closePopup").on("click", function () {
            $(".popupLayout").hide();
        });

        for (i = 18; i < 41; i++) {
            if (i % 2 == 0) {
                hour = i / 2;
                singleHour = calendarHandler.singleHour.replaceAll(
                    "&hour&",
                    hour + ":00"
                );
            } else {
                hour = i / 2 - 0.5;
                singleHour = calendarHandler.singleHour.replaceAll(
                    "&hour&",
                    hour + ":30"
                );
            }
            if (25 < i && i < 31) {
                singleHour = singleHour.replace("singleHour", "disable");
            }
            $(".popupLayout .hours").append(singleHour);
        }
        allDates.forEach((element) => {
            start = element.interval.split(" - ")[0];
            end = element.interval.split(" - ")[1];
            next = false;
            $(".hourItem").each(function () {
                if (!$(this).hasClass("disable")) {
                    if (
                        $(this).data("hour") == start ||
                        $(this).data("hour") == end ||
                        next
                    ) {
                        $(this).addClass("lock");
                        $(this).removeClass("singleHour");
                        $(this).data("hour") == start
                            ? (next = true)
                            : (next = false);
                    }
                } else {
                    next = false;
                }
            });
        });
        $(".popupLayout").on("click", ".singleHour", function () {
            let interval =
                $(this).text() +
                " - " +
                $(this)
                    .text()
                    .replace(
                        $(this).text().split(":")[0],
                        parseInt($(this).text().split(":")[0]) + 1
                    );
            $(".clientDetails .interval").val(interval);
        });
    },
    sendData: function (elem) {
        (parent = $(elem).closest(".popupLayout")),
            (content = {
                fullname: parent.find(".name").val(),
                email: parent.find(".clientDetails .email").val(),
                interval: parent.find(".clientDetails .interval").val(),
                date: parent.find(".header .date").text(),
            });

        let url = "/api/schedules";
        $.post(url, { content: content }, function (response) {
            if (response == "success") {
                location.reload();
            } else {
                $(".popupLayout .header .details").html(response);
            }
        });
    },
};

const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];
$(function () {
    calendarHandler.init();
    $("#showAppointments").DataTable({
        order: [[0, "asc"]],
    });
});
function formatData(date) {
    return date.getDate();
}
function daysInMonth(month, year) {
    return new Date(year, month + 1, 0).getDate();
}
