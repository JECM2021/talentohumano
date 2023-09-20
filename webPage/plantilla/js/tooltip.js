(function () {

	'use strict';

	var Utils = Utils || {};

	Utils.Tooltip = function (el) {
		if (el) {
			this.el = el;

			this.buildDOM();
			this.attachEvents();
		}
	};

	Utils.Tooltip.prototype.attachEvents = function () {
		var el = this.el,
			that = this;

		el.addEventListener('focus', function () {
			that.showTooltip.call(that);
		});

		el.addEventListener('blur', function () {
			that.hideTooltip.call(that);
		});
	};

	Utils.Tooltip.prototype.showTooltip = function () {
		var tipText;

		this.tooltip.style.left = this.el.offsetLeft+ 'px';
		this.tooltip.style.top = this.el.offsetTop + this.el.offsetHeight + 7 + 'px';
		this.tooltip.style.display = 'block';

		tipText = this.tooltip.getElementsByTagName('p')[0];
		tipText.innerHTML = this.el.title;
	};

	Utils.Tooltip.prototype.hideTooltip = function () {
		this.tooltip.style.display = 'none';
	};

	Utils.Tooltip.prototype.buildDOM = function () {
		var theTooltip = document.getElementById('tooltip'),
			body = document.getElementsByTagName('body')[0],
			tipText,
			tipArrow;

		if (!theTooltip) {
			theTooltip = document.createElement('div');
			theTooltip.id = 'tooltip';
			theTooltip.className = 'tooltip';

			tipArrow = document.createElement('span');
			tipText = document.createElement('p');

			body.appendChild(theTooltip);
			theTooltip.appendChild(tipText);
			theTooltip.appendChild(tipArrow);
		}

		this.tooltip = theTooltip;

		return;
	};

	Utils.ErrorTooltip = function (el) {
		Utils.Tooltip.call(this, el); // super
	};

	Utils.ErrorTooltip.prototype = new Utils.Tooltip();

	Utils.ErrorTooltip.prototype.showTooltip = function () {
		Utils.Tooltip.prototype.showTooltip.call(this);
		this.tooltip.className = this.tooltip.className + ' error';
	};

	Utils.ErrorTooltip.prototype.hideTooltip = function () {
		this.tooltip.className = this.tooltip.className.replace('error', '');
		Utils.Tooltip.prototype.hideTooltip.call(this);
	};

	window.addEventListener('load', function () {
		var inputs = document.getElementsByClassName('showTooltip'),
			errorInputs = document.getElementsByClassName('showErrorTooltip');

		Array.prototype.forEach.call(inputs, function (key) {
			new Utils.Tooltip(key);
		});

		Array.prototype.forEach.call(errorInputs, function (key) {
			new Utils.ErrorTooltip(key);
		});
	});
})();
