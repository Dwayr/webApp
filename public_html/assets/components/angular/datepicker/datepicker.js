(function($) {
"use strict";

var TYPEDATE_FORMAT = 'YYYY-MM-DD';

function Datepicker(element, options) {
    var self = this,
        $element = $(element),
        defaults = {
            initial_value: null,
            dateformat: 'DD.MM.YYYY',
            placeholder: $element.attr('placeholder') || '',
            theme: 'basic',
            readonly: true,
            vertical_offset: 3,
            is_invalid_date: null
        };

    self.options = $.extend({}, defaults, options);
    self.$element = $element;
    self.value = self.options.initial_value ? moment(self.options.initial_value, self.options.dateformat) : self.parse_value($element);
    self.init();
}
/**
 * Initializes the datepicker.
 */
Datepicker.prototype.init = function() {
    var self = this,
        lastopened;

    self.$picker = $('<div></div>')
    .hide()
    .addClass("picker")

    //internal events
    .on('_render.datepicker', function() {
        self.$picker
        .trigger('_reposition')
        .html("<div class='header'><div class='prev'>&lt;</div><div class='next'>&gt;</div><span class='month'>" + self.displayed.format('MMMM YYYY') + "</span></div><div class='calendar'>" + self.month_table(self.displayed, self.value) + '</div>');
    })
    .on('_reposition.datepicker', function() {
        var pos = self.$input.offset();
        pos.top += self.$input.outerHeight() + self.options.vertical_offset;
        self.$picker
        .offset(pos);
    })

    //user interaction
    .on('click.datepicker', '.month', function(e) {
        self.displayed = moment().date(1);
        self.$picker.trigger('_render');
    })
    .on('click.datepicker', '.prev', function() {
        self.displayed.subtract(1, 'month');
        self.$picker.trigger('_render');
    })
    .on('click.datepicker', '.next', function() {
        self.displayed.add(1, 'month');
        self.$picker.trigger('_render');
    })
    .on('click.datepicker', '.day:not(.invalid)', function(e) {
        var picked = moment($(e.target).attr('data-date'));
        self.set_value(picked);
    })
    .on('click.datepicker', function(e) {
        e.stopPropagation(); //prevent event bubbling
    });


    self.$input = $('<input type="text" class="input"/>')
    .attr('readonly', self.options.readonly)
    .attr('class', self.$element.attr('class'))
    .attr('placeholder', self.options.placeholder)
    .val(self.format_value(self.value))

    //user interaction
    .on('change.datepicker', function(e) {
        self.set_value(self.parse_value(this));
    })
    .on('click.datepicker focus.datepicker', function(e) {
        if (e.type == 'click' && self.$picker.is(':visible') && (new Date() - lastopened > 500)) {
            self.$element.trigger('hidedatepicker');
        } else {
            $('.hasDatepicker').not(self.$element).trigger('hidedatepicker');
            self.$element.trigger('showdatepicker');
        }
        return false;
    });


    self.$container = $('<div class="datepicker"></div>')
    .addClass(self.options.theme)
    .append(self.$input)
    .append(self.$picker);


    self.$element
    .attr('readonly', 'readonly')
    .addClass('hasDatepicker')

    //api events
    .on('showdatepicker.datepicker', function(e) {
        self.displayed = (self.value || moment()).clone().date(1);
        self.$picker.show().trigger('_render');
        lastopened = new Date();

        //global events
        $(document)
        .on('wheel.datepicker', function() {
            self.$picker.trigger('_reposition');
        })
        .on('click.datepicker', function(e) {
            self.$element.trigger('hidedatepicker');
        });
    })
    .on('hidedatepicker.datepicker', function() {
        self.displayed = null;
        self.$picker.hide();

        //global events
        $(document).off('.datepicker');
    })

    //user interaction
    .on('change.datepicker', function(e, internal_event) {
        if (internal_event != 'internal_event') {
            self.set_value(self.parse_value(this));
        }
    })
    .hide()
    .after(self.$container);
};
/**
 * Sets the current datepicker value.
 */
Datepicker.prototype.set_value = function(value) {
    var self = this;

    if (!moment(value).isValid()) {
        return;
    }

    self.value = value;
    self.$input.val(value.format(self.options.dateformat));
    self.$element
    .val(self.format_value(value))
    .trigger('change', 'internal_event') //prevent endless loop
    .trigger('hidedatepicker');
};
/**
 * Parses the current value of the input element.
 */
Datepicker.prototype.parse_value = function(input) {
    var self = this,
        $input = $(input),
        format = $input.is('[type="date"]') ? TYPEDATE_FORMAT : self.options.dateformat,
        parsed = moment($input.val(), format);
    return parsed.isValid() ? parsed : null;
};
/**
 * Formats the specified value for the input element.
 */
Datepicker.prototype.format_value = function(value) {
    var self = this,
        format = self.$element.is('[type="date"]') ? TYPEDATE_FORMAT : self.options.dateformat;

    value = moment(value);
    return value.isValid() ? value.format(format) : null;
};
/**
 * Returns day of the week with monday = 0, sunday = 6
 */
Datepicker.prototype.weekday = function(date) {
    return (moment(date).day() + 6) % 7;
};
/**
 * Generates an array of weeks, each containing the dates of the weekdays.
 */
Datepicker.prototype.month_array = function(date) {
    var self = this,
        week = [],
        weeks = [week],
        first = moment(date).date(1),
        current = first,
        i;
    for (i=0; i<self.weekday(first); i++) {
        week.push(null); //fill up week before first of month
    }
    for (i=0; i<first.daysInMonth(); i++) {
        current = first.clone().add(i, 'days');
        if (self.weekday(current) == 0 && week.length > 0) {
            week = [];
            weeks.push(week);
        }
        week.push(current);
    }
    for (i=self.weekday(current)+1; i<7; i++) {
        week.push(null); //fill up week after last of month
    }
    return weeks;
};
/**
 * Generates the html structure for the calendar.
 */
Datepicker.prototype.month_table = function(displayed, value) {
    var self = this,
        today = moment(),
        wd = moment.weekdaysMin(),
        t = ['<table><tr><th>', wd[1], '</th><th>', wd[2], '</th><th>', wd[3], '</th><th>', wd[4], '</th><th>', wd[5], '</th><th>', wd[6], '</th><th>', wd[0], '</th></tr>'];
    $.each(self.month_array(displayed), function(ix, week) {
        t.push('<tr>');
        $.each(week, function(ix, day) {
            var label = day ? day.format('D') : '',
                title = day ? day.format(self.options.dateformat) : '',
                repr = day ? day.format() : '',
                classes = [];
            if (day) {
                classes.push('day');
                if (day.isSame(today, 'day')) classes.push('today');
                if (day.isSame(value, 'day')) classes.push('current');
                if (self.options.is_invalid_date && self.options.is_invalid_date(day)) classes.push('invalid');
            }
            t.push("<td class='" + classes.join(' ') + "' data-date='" + repr + "' title='" + title + "'>" + label + "</td>");
        });
        t.push('</tr>');
    });
    t.push('</table>');
    return t.join('');
};


/**
 * Plugin/directive registration
 */

$.fn.datepicker = function(options) {
    return this.each(function(ix, el) {
        new Datepicker(el, options);
    });
};


if (typeof angular != 'undefined') {
    angular.module('datepicker', [])
    .directive('datepicker', [function(utils) {
        return {
            restrict: 'A',
            require: '?ngModel',
            link: function(scope, element, attrs, ngModel) {
                var options = scope.$eval(attrs.datepicker) || {},
                    picker;

                if (!ngModel) {
                    return;
                }

                options.initial_value = scope.$eval(attrs.ngModel);
                picker = new Datepicker(element, options);

                ngModel.$render = function() {
                    element.val(ngModel.$viewValue).trigger('change');
                };
            }
        }
    }]);
}

}(jQuery));