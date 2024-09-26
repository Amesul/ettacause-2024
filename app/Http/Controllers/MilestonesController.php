<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class MilestonesController extends Controller
{
    public function show()
    {
        $js = "// JS
const milestones = new Map([
        [0, ''],
        [10000, ''],
        ]);
const keys = Array.from(milestones.keys());
const findClosestMax = function (x, arr) {
  var indexArr = arr.map(function (k) {
    return Math.abs(k - x);
  });
  var min = Math.min.apply(Math, indexArr);
  if (arr[indexArr.indexOf(min)] <= x) return arr[indexArr.indexOf(min) + 1];
  else return arr[indexArr.indexOf(min)];
};

const findClosestMin = function (x, arr) {
  var indexArr = arr.map(function (k) {
    return Math.abs(k - x);
  });
  var min = Math.min.apply(Math, indexArr);
  if (arr[indexArr.indexOf(min)] > x) return arr[indexArr.indexOf(min) - 1];
  else return arr[indexArr.indexOf(min)];
};

const clamp = (num, min, max) => Math.min(Math.max(num, min), max);

document.addEventListener('goalLoad', function (obj) {
  let currentMilestone = findClosestMax(obj.detail.amount.current, keys);
  let previousMilestone = findClosestMin(obj.detail.amount.current, keys);
  let percent = (obj.detail.amount.current - previousMilestone) * (100 / (currentMilestone - previousMilestone));
  $('#goal-total').text(`\${currentMilestone} \${obj.detail.currency}`);
  $('#goal-current').text(
      `\${obj.detail.amount.current} \${obj.detail.currency}`
  );
  $('#milestone-current').text(`\${milestones.get(currentMilestone)}`);
  $('#goal-current-solo').text(
      `\${obj.detail.amount.current} \${obj.detail.currency}`
  );
  if (obj.detail.amount.current > 0) {
      $('#bar').css({
      opacity: 100,
    });
  }
  $('#bar').css({
    width: clamp(percent, 0, 100) + '%',
  });
});

document.addEventListener('goalEvent', function (obj) {
    let currentMilestone = findClosestMax(obj.detail.amount.current, keys);
    let previousMilestone = findClosestMin(obj.detail.amount.current, keys);
    let percent = (obj.detail.amount.current - previousMilestone) * (100 / (currentMilestone - previousMilestone));
    $('#goal-total').text(`\${currentMilestone} \${obj.detail.currency}`);
    $('#goal-current').text(
    `\${obj.detail.amount.current} \${obj.detail.currency}`
    );
    $('#milestone-current').text(`\${milestones.get(currentMilestone)}`);
    $('#goal-current-solo').text(`\${obj.detail.amount.current} \${obj.detail.currency}`);
    if (obj.detail.amount.current > 0) {
    $('#bar').css({
        opacity: 100,
    });
  }
  $('#bar').css({
    width: clamp(percent, 0, 100) + '%',
  });
});";
        return view('goals.show', [
            'js' => $js
        ]);
    }
    public function create()
    {
        return view('goals.create');
    }

    /**
     * @throws GuzzleException
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'charity-milestones' => ['required', 'url'],
        ]);
        $slc_access_token = substr($validated['charity-milestones'], 48);

        $streamlabs = new Client([]);
        $res = $streamlabs->get('https://streamlabscharity.com/api/v1/widgets/milestones/' . $slc_access_token);
        $data = json_decode($res->getBody());

        $milestones = $data->campaign->milestones;

        if (empty($milestones)) {
            return back()->with('danger', 'Aucun jalon trouvé.');
        }

        $js_map = "const milestones = new Map([
        [0, ''],
        ";
        foreach ($milestones as $milestone) {
            $amount = $milestone->amount / 100;
            $title = json_encode($milestone->display_name);
            $js_map = $js_map . "[$amount, $title],
        ";
        }
        $max_amount = end($milestones)->amount;
        $js_map = $js_map . "[$max_amount, 'GOALS TERMINÉS ! Merci infiniment <3']
    ]);";

        $js_code = "// JS
$js_map
const keys = Array.from(milestones.keys());
const findClosestMax = function (x, arr) {
  var indexArr = arr.map(function (k) {
    return Math.abs(k - x);
  });
  var min = Math.min.apply(Math, indexArr);
  if (arr[indexArr.indexOf(min)] <= x) return arr[indexArr.indexOf(min) + 1];
  else return arr[indexArr.indexOf(min)];
};

const findClosestMin = function (x, arr) {
  var indexArr = arr.map(function (k) {
    return Math.abs(k - x);
  });
  var min = Math.min.apply(Math, indexArr);
  if (arr[indexArr.indexOf(min)] > x) return arr[indexArr.indexOf(min) - 1];
  else return arr[indexArr.indexOf(min)];
};

const clamp = (num, min, max) => Math.min(Math.max(num, min), max);

document.addEventListener('goalLoad', function (obj) {
  let currentMilestone = findClosestMax(obj.detail.amount.current, keys);
  let previousMilestone = findClosestMin(obj.detail.amount.current, keys);
  let percent = (obj.detail.amount.current - previousMilestone) * (100 / (currentMilestone - previousMilestone));
  $('#goal-total').text(`\${currentMilestone} \${obj.detail.currency}`);
  $('#goal-current').text(
      `\${obj.detail.amount.current} \${obj.detail.currency}`
  );
  $('#milestone-current').text(`\${milestones.get(currentMilestone)}`);
  $('#goal-current-solo').text(
      `\${obj.detail.amount.current} \${obj.detail.currency}`
  );
  if (obj.detail.amount.current > 0) {
      $('#bar').css({
      opacity: 100,
    });
  }
  $('#bar').css({
    width: clamp(percent, 0, 100) + '%',
  });
});

document.addEventListener('goalEvent', function (obj) {
    let currentMilestone = findClosestMax(obj.detail.amount.current, keys);
    let previousMilestone = findClosestMin(obj.detail.amount.current, keys);
    let percent = (obj.detail.amount.current - previousMilestone) * (100 / (currentMilestone - previousMilestone));
    $('#goal-total').text(`\${currentMilestone} \${obj.detail.currency}`);
    $('#goal-current').text(
    `\${obj.detail.amount.current} \${obj.detail.currency}`
    );
    $('#milestone-current').text(`\${milestones.get(currentMilestone)}`);
    $('#goal-current-solo').text(`\${obj.detail.amount.current} \${obj.detail.currency}`);
    if (obj.detail.amount.current > 0) {
    $('#bar').css({
        opacity: 100,
    });
  }
  $('#bar').css({
    width: clamp(percent, 0, 100) + '%',
  });
});";

        return view('goals.show', [
            'js' => $js_code,
        ]);
    }
}
