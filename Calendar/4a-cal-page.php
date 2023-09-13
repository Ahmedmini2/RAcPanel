<!DOCTYPE html>
<html dir="ltr">
  <head>
    <title>المواعيد</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <link rel="icon" type="image/png" href="favicon.png">

    <!-- ANDROID + CHROME + APPLE + WINDOWS APP -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="white">
    <link rel="apple-touch-icon" href="icon-512.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Calendar">
    <meta name="msapplication-TileImage" content="icon-512.png">
    <meta name="msapplication-TileColor" content="#ffffff">

    <!-- WEB APP MANIFEST -->
    <!-- https://web.dev/add-manifest/ -->
    <link rel="manifest" href="5-manifest.json">

    <!-- SERVICE WORKER -->
    <script>
    if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register("5-worker.js");
    }
    </script>

    <!-- JS + CSS -->
    <script src="4b-calendar.js"></script>
    <link rel="stylesheet" href="4c-calendar.css">
  </head>
  <body>
    <?php
    // (A) DAYS MONTHS YEAR
    $months = [
      1 => "يناير", 2 => "فبراير", 3 => "مارس", 4 => "ابريل",
      5 => "مايو", 6 => "يونيو", 7 => "يوليو", 8 => "اغسطس",
      9 => "سبتمبر", 10 => "اكتوبر", 11 => "نوفمبر", 12 => "ديسيمبر"
    ];
    $monthNow = date("m");
    $yearNow = date("Y"); ?>

    <!-- (B) PERIOD SELECTOR -->
    <div id="calHead">
      <div id="calPeriod">
        <input id="calBack" type="button" class="mi" value="&lt;">
        <select id="calMonth"><?php foreach ($months as $m=>$mth) {
          printf("<option value='%u'%s>%s</option>",
            $m, $m==$monthNow?" selected":"", $mth
          );
        } ?></select>
        <input id="calYear" type="number" value="<?=$yearNow?>">
        <input id="calNext" type="button" class="mi" value="&gt;">
      </div>
      <input id="calAdd" 
      type="button" 
      class="btn  rounded-pill mb-0 col-md-2 col-sm-6 col-xs-6" 
      value="أضافة موعد جديد">
    </div>

    <!-- (C) CALENDAR WRAPPER -->
    <div id="calWrap">
      <div id="calDays"></div>
      <div id="calBody"></div>
    </div>

    <!-- (D) EVENT FORM -->
    <dialog id="calForm"><form method="dialog">
      <div id="evtCX">X</div>
      <h2 class="evt100">إضافة اجتماع</h2>
      <div class="evt50">
        <label>البداية</label>
        <input id="evtStart" type="datetime-local" required>
      </div>
      <div class="evt50">
        <label>النهاية</label>
        <input id="evtEnd" type="datetime-local" required>
      </div>
      <div class="evt50">
        <label>لون النص</label>
        <input id="evtColor" type="color" value="#000000" required>
      </div>
      <div class="evt50">
        <label>لون الخلفيه</label>
        <input id="evtBG" type="color" value="#ffdbdb" required>
      </div>
      <div class="evt100">
        <label>الاجتماع</label>
        <input id="evtTxt" type="text" required>
      </div>
      <div class="evt100">
        <button type="button" id="btn1" class="btn bg-gradient-yellow" data-bs-toggle="modal" data-bs-target="#exampleModal">
          إضافة محضر الاجتماع
        </button>
        <div class="modal fade position-inherit" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1080px;">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">محضر الإجتماع</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close" style="position: relative;left: 0%;right: 80%;">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <label>محضر الاجتماع</label>
              <textarea id="evtDesc" type="text" style="width: -webkit-fill-available;height: 300px;" style="text-align:left;"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="evt100">
        <input type="hidden" id="evtID">
        <input type="button" id="evtDel" value="Delete">
        <input type="submit" id="evtSave" value="Save">
      </div>
    </form></dialog>
  </body>
</html>