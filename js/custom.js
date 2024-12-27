

function initSortTable() {
  $("table.table-sort-by-column").each(function (index, element) {
    let thisTable = $(this);
    let self = thisTable.attr("data-self-name");
    let originalURL = document.location.toString();
    let arr0 = originalURL.split("#");
    originalURL = arr0[0];
    let arr1 = originalURL.split("?");
    originalURL = arr1[0];
    let args = arr1[1] || "";
    let argArray = args.split("&");
    let queryObject = {};
    for (let i in argArray) {
      let arr2 = argArray[i].split("=");
      if (arr2[0] != "") {
        queryObject[arr2[0]] = arr2[1];
      }
    }
    let currentOrderMethod = queryObject.ordertype || "";
    let lastColumn = queryObject.orderby || "";
    thisTable.find("td.order-controll").each(function (index, element) {
      let thisCel = $(this);
      let columnName = thisCel.attr("data-col-name");
      if (lastColumn == columnName) {
        if (currentOrderMethod == "asc") {
          queryObject.ordertype = "desc";
          thisCel.attr("data-order-method", "asc");
        } else if (currentOrderMethod == "desc") {
          queryObject.ordertype = "asc";
          thisCel.attr("data-order-method", "desc");
        } else {
          queryObject.ordertype = "asc";
          thisCel.attr("data-order-method", "desc");
        }
      } else {
        queryObject.ordertype = "asc";
      }
      queryObject.orderby = columnName;
      let arr3 = [];
      for (let j in queryObject) {
        arr3.push(j + "=" + queryObject[j]);
      }
      let args3 = arr3.join("&");
      let finalURL = originalURL + "?" + args3;
      thisCel.find(" > a").attr("href", finalURL);
    });
  });
}

function initDatetimePicker() {
  let debugDatetimePicker = false;
  
  // Change input type from date to text and add class for date-picker
  $('input[type="date"]').each(function (index, element) {
    let obj = $(this);
    obj.attr('type', 'text');
    obj.addClass('date-picker');
    let html = obj[0].outerHTML;
    let html2 =
      '<div class="input-datetime-wrapper date">\r\n' +
      html + '\r\n' +
      '</div>\r\n';
    obj.replaceWith(html2);
  });

  // Change input type from time to text and add class for time-picker
  $('input[type="time"]').each(function (index, element) {
    let obj = $(this);
    obj.attr('type', 'text');
    obj.addClass('time-picker');
    let html = obj[0].outerHTML;
    let html2 =
      '<div class="input-datetime-wrapper time">\r\n' +
      html + '\r\n' +
      '</div>\r\n';
    obj.replaceWith(html2);
  });

  // Change input type from datetime-local to text and add class for date-time-picker
  $('input[type="datetime-local"]').each(function (index, element) {
    let obj = $(this);
    obj.attr('type', 'text');
    obj.addClass('date-time-picker');
    let html = obj[0].outerHTML;
    let html2 =
      '<div class="input-datetime-wrapper date-time">\r\n' +
      html + '\r\n' +
      '</div>\r\n';
    obj.replaceWith(html2);
  });

  // Initialize date-picker if there are inputs with the class 'date-picker'
  if ($('.date-picker').length) {
    $('.date-picker').each(function() {
      var minDate = $(this).data('mindate') || false;
      var maxDate = $(this).data('maxdate') || false;
      $(this).datetimepicker({
        minDate: minDate,
        maxDate: maxDate,
        format: 'YYYY-MM-DD',
        debug: debugDatetimePicker
      }).on('dp.change', function (e) {
        $(this).datetimepicker('hide');
      });
    });
  }

  // Initialize time-picker if there are inputs with the class 'time-picker'
  if ($('.time-picker').length) {
    $('.time-picker').datetimepicker({
      format: 'HH:mm:ss',
      debug: debugDatetimePicker
    }).on('dp.change', function (e) {
      $(this).datetimepicker('hide');
    });
  }

  // Initialize date-time-picker if there are inputs with the class 'date-time-picker'
  if ($('.date-time-picker').length) {
    $('.date-time-picker').each(function() {
      var minDate = $(this).data('mindate') || false;
      var maxDate = $(this).data('maxdate') || false;
      $(this).datetimepicker({
        minDate: minDate,
        maxDate: maxDate,
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: 'day',
        debug: debugDatetimePicker
      }).on('dp.change', function (e) {
        $(this).datetimepicker('hide');
      });
    });
  }
}

function initSortData()
{
  $("tbody.data-table-manual-sort").each(function () {
    let dataToSort = $(this)[0];
    Sortable.create(dataToSort, {
      animation: 150,
      scroll: true,
      handle: ".data-sort-handler",
      onEnd: function () {
        // do nothing
        updateNumber($(dataToSort));
      },
    });
  });
}

function initCheckAll()
{
  $("table").each(function () {
    if ($(".check-master").length > 0) {
      $(".check-master").each(function () {
        $(this).on("change", function () {
          let checked = $(this)[0].checked;
          let selector = $(this).attr('data-selector');
          let table = $(this).closest("table");
          table.find(".check-slave").filter(selector).each(function () {
            $(this)[0].checked = checked;
          });
        });
      });
    }
  });
}

function initAjaxSupport()
{
  if ($('[data-ajax-support="true"]').length == 0) {
    $(document).on("click", '[type="submit"][name="user_action"][value="delete"]', function (e2) {
        if(!confirm($(this).attr("data-onclik-message")))
        {
          e2.preventDefault();
          e2.stopPropagation();
        }
      }
    );
  }
}

function initMultipleSelect()
{
  document.querySelectorAll('select[multiple]').forEach(select => new MultiSelect(select));
}


function initOrderUrl(queryString)
{
  const urlParams = new URLSearchParams(queryString);
  const orderby = urlParams.get('orderby');
  const ordertype = urlParams.get('ordertype');

  if(typeof orderby != 'undefined')
  {
    let orderbyInput = $('<input />');
    orderbyInput.attr('type', 'hidden');
    orderbyInput.attr('name', 'orderby');
    orderbyInput.attr('value', orderby);

    if($('form.filter-form [name="orderby"]').length)
    {
      $('form.filter-form [name="orderby"]').remove();
    }
    $('form.filter-form').append(orderbyInput);
  }

  if(typeof ordertype != 'undefined')
  {
    let ordertypeInput = $('<input />');
    ordertypeInput.attr('type', 'hidden');
    ordertypeInput.attr('name', 'ordertype');
    ordertypeInput.attr('value', ordertype);
    if($('form.filter-form [name="ordertype"]').length)
    {
      $('form.filter-form [name="ordertype"]').remove();
    }
    $('form.filter-form').append(ordertypeInput);
  }
}


function updateNumber(dataToSort) {
  let frm = dataToSort.closest("form");
  if (frm.find("span.new-sort-order").length) {
    frm.find("span.new-sort-order").remove();
  }
  let span = $("<span />");
  span.addClass("new-sort-order");
  frm.append(span);
  let offset = parseInt(dataToSort.attr("data-offset"));
  let i = 0;
  dataToSort.find("tr").each(function (e) {
    let tr = $(this);
    i++;
    let order = offset + i;
    tr.find(".data-number").text(order);
    let pk = tr.attr("data-primary-key");
    let orderInput = $("<input />");
    orderInput.attr({
      type: "hidden",
      name: "new_order[]",
      value: JSON.stringify({ primary_key: pk, sort_order: order }),
    });
    span.append(orderInput);
  });
  dataToSort
    .closest("form")
    .find('button[name="user_action"][value="sort_order"]')
    .removeAttr("disabled");
}
function saveOrder() {}
function splitWithTail(str, delimiter, count) {
  const parts = str.split(delimiter);
  const tail = parts.slice(count).join(delimiter);
  const result = parts.slice(0, count);
  result.push(tail);
  return result;
}
jQuery(function ($) {
  initCheckAll();
  initAjaxSupport();
  initDatetimePicker();
  initMultipleSelect();
  initSortTable();
  initSortData();
  initOrderUrl(window.location.search);
});