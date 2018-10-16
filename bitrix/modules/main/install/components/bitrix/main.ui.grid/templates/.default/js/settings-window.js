;(function() {
	'use strict';

	BX.namespace('BX.Grid');


	/**
	 * @param {BX.Main.grid} parent
	 * @constructor
	 */
	BX.Grid.SettingsWindow = function(parent)
	{
		this.parent = null;
		this.popupItems = null;
		this.items = null;
		this.popup = null;
		this.sourceContent = null;
		this.applyButton = null;
		this.resetButton = null;
		this.cancelButton = null;
		this.init(parent);
	};


	BX.Grid.SettingsWindow.prototype = {
		init: function(parent)
		{
			this.parent = parent;
			BX.bind(this.parent.getContainer(), 'click', BX.proxy(this._onContainerClick, this));
			BX.addCustomEvent(window, 'Grid::columnMoved', BX.proxy(this._onColumnMoved, this));
		},

		destroy: function()
		{
			BX.unbind(this.parent.getContainer(), 'click', BX.proxy(this._onContainerClick, this));
			BX.removeCustomEvent(window, 'Grid::columnMoved', BX.proxy(this._onColumnMoved, this));
			this.getPopup().close();
		},


		/**
		 * Gets select all button
		 * @return {?HTMLElement}
		 */
		getSelectAllButton: function()
		{
			if (!this.selectAllButton)
			{
				this.selectAllButton = BX.Grid.Utils.getByClass(
					this.getPopup().contentContainer,
					this.parent.settings.get('classSettingsWindowSelectAll'),
					true
				);
			}

			return this.selectAllButton;
		},


		/**
		 * Gets unselect all button
		 * @return {?HTMLElement}
		 */
		getUnselectAllButton: function()
		{
			if (!this.unselectAllButton)
			{
				this.unselectAllButton = BX.Grid.Utils.getByClass(
					this.getPopup().contentContainer,
					this.parent.settings.get('classSettingsWindowUnselectAll'),
					true
				);
			}

			return this.unselectAllButton;
		},


		/**
		 * @private
		 */
		reset: function()
		{
			this.popupItems = null;
			this.allColumns = null;
			this.items = null;
		},


		_onContainerClick: function(event)
		{
			if (BX.hasClass(event.target, this.parent.settings.get('classSettingsButton')))
			{
				this._onSettingsButtonClick(event);
			}
		},

		_onSettingsButtonClick: function()
		{
			this.getPopup().show();
		},


		/**
		 * @private
		 * @return {?HTMLElement}
		 */
		getSourceContent: function()
		{
			if (!this.sourceContent)
			{
				this.sourceContent = BX.Grid.Utils.getByClass(this.parent.getContainer(), this.parent.settings.get('classSettingsWindow'), true);
			}

			return this.sourceContent;
		},


		/**
		 * Gets popup items of columns
		 * @return {?HTMLElement[]}
		 */
		getPopupItems: function()
		{
			var popupContainer;

			if (!this.popupItems)
			{
				popupContainer = this.getPopup().contentContainer;
				this.popupItems = BX.Grid.Utils.getByClass(popupContainer, this.parent.settings.get('classSettingsWindowColumn'));
			}

			return this.popupItems;
		},


		/**
		 * Gets selected columns ids
		 * @return {string[]}
		 */
		getSelectedColumns: function()
		{
			var columns = [];

			this.getItems().forEach(function(column) {
				column.isSelected() && columns.push(column.getId());
			});

			return columns;
		},


		/**
		 * Restores columns to default state
		 */
		restoreColumns: function()
		{
			this.getItems().forEach(function(column) {
				column.restore();
			});

			this.sortItems();
			this.reset();
		},


		/**
		 * Restores columns to saved state
		 */
		restoreLastColumns: function()
		{
			this.getItems().forEach(function(current) {
				current.restoreState();
			});
		},


		/**
		 * Updates columns state
		 */
		updateColumnsState: function()
		{
			this.getItems().forEach(function(current) {
				current.updateState();
			});
		},


		/**
		 * Saves columns settings
		 * @param {string[]} columns - ids
		 * @param {?function} callback
		 */
		saveColumns: function(columns, callback)
		{
			var options = this.parent.getUserOptions();
			var columnNames = this.getColumnNames();
			var batch = [];

			batch.push({
				action: options.getAction('GRID_SET_COLUMNS'),
				columns: columns.join(',')
			});

			batch.push({
				action: options.getAction('SET_CUSTOM_NAMES'),
				custom_names: columnNames
			});

			if (this.isForAll())
			{
				batch.push({
					action: options.getAction('GRID_SAVE_SETTINGS'),
					view_id: 'default',
					set_default_settings: 'Y',
					delete_user_settings: 'Y'
				});
			}

			options.batch(batch, BX.delegate(function() {
				this.parent.reloadTable(null, null, callback);
			}, this));

			this.updateColumnsState();
		},


		/**
		 * Disables edit for all columns
		 */
		disableAllColumnslabelEdit: function()
		{
			this.getItems().forEach(function(column) {
				column.disableEdit();
			});
		},


		/**
		 * Gets all columns ids
		 * @return {string[]}
		 */
		getAllColumns: function()
		{
			if (!this.allColumns)
			{
				this.allColumns = this.getItems().map(function(column) {
					return column.getId();
				});
			}

			return this.allColumns;
		},

		isShowedColumn: function(columnName)
		{
			return this.getSelectedColumns().some(function(name) {
				return name === columnName;
			});
		},

		getShowedColumns: function()
		{
			var result = [];
			var cells = this.parent.getRows().getHeadFirstChild().getCells();

			[].slice.call(cells).forEach(function(column) {
				if ("name" in column.dataset)
				{
					result.push(column.dataset.name);
				}
			});

			return result;
		},

		sortItems: function()
		{
			var showedColumns = this.getShowedColumns();
			var allColumns = {};

			this.getAllColumns().forEach(function(name) {
				allColumns[name] = name;
			}, this);

			var counter = 0;
			Object.keys(allColumns).forEach(function(name) {
				if (this.isShowedColumn(name))
				{
					allColumns[name] = showedColumns[counter];
					counter++;
				}

				var current = this.getColumnByName(allColumns[name]);
				current && current.parentNode.appendChild(current);
			}, this);
		},


		/**
		 * Gets current columns names
		 * @return {object}
		 */
		getColumnNames: function()
		{
			var names = {};
			this.getItems().map(function(column) {
				if (column.isEdited())
				{
					names[column.getId()] = column.getTitle();
				}
			});

			return names;
		},


		/**
		 * Gets column node by name
		 * @param {string} name
		 * @return {?HTMLElement}
		 */
		getColumnByName: function(name)
		{
			return BX.Grid.Utils.getBySelector(
				this.getPopup().popupContainer,
				'.' + this.parent.settings.get('classSettingsWindowColumn') + '[data-name="'+name+'"]',
				true
			);
		},

		_onColumnMoved: function()
		{
			this.sortItems();
			this.reset();
		},


		onResetButtonClick: function()
		{
			this.parent.confirmDialog(
				{
					CONFIRM: true,
					CONFIRM_MESSAGE: this.parent.arParams.CONFIRM_RESET_MESSAGE
				},
				BX.delegate(function() {
					this.enableWait(this.getApplyButton());

					this.parent.getUserOptions().reset(this.isForAll(), BX.delegate(function() {
						this.parent.reloadTable(null, null, BX.delegate(function() {
							this.restoreColumns();
							this.disableWait(this.getApplyButton());
							this.getPopup().close();
						}, this));
					}, this));
				}, this)
			);
		},


		/**
		 * Gets reset button id
		 * @return {string}
		 */
		getResetButtonId: function()
		{
			return this.parent.getContainerId() + '-grid-settings-reset-button';
		},


		onApplyButtonClick: function()
		{
			this.parent.confirmDialog(
				{
					CONFIRM: this.isForAll(),
					CONFIRM_MESSAGE: this.parent.getParam('SETTINGS_FOR_ALL_CONFIRM_MESSAGE')
				},
				BX.delegate(function() {
					this.enableWait(this.getApplyButton());
					this.saveColumns(this.getSelectedColumns(), BX.delegate(function() {
						this.getPopup().close();
						this.disableWait(this.getApplyButton());
						this.unselectForAllCheckbox();
					}, this));
				}, this),
				BX.delegate(function() {
					this.unselectForAllCheckbox();
				}, this)
			);
		},


		/**
		 * Gets apply button id
		 * @return {string}
		 */
		getApplyButtonId: function()
		{
			return this.parent.getContainerId() + '-grid-settings-apply-button';
		},


		/**
		 * Gets apply button
		 * @return {HTMLElement}
		 */
		getApplyButton: function()
		{
			if (this.applyButton === null)
			{
				this.applyButton = BX(this.getApplyButtonId());
			}

			return this.applyButton;
		},


		/**
		 * Gets cancel button id
		 * @return {string}
		 */
		getCancelButtonId: function()
		{
			return this.parent.getContainerId() + '-grid-settings-cancel-button';
		},


		/**
		 * Gets cancel button
		 * @return {HTMLElement}
		 */
		getCancelButton: function()
		{
			if (this.cancelButton === null)
			{
				this.cancelButton = BX(this.getCancelButtonId());
			}

			return this.cancelButton;
		},


		/**
		 * Unselect for all checkbox
		 */
		unselectForAllCheckbox: function()
		{
			var checkbox = this.getForAllCheckbox();
			checkbox && (checkbox.checked = null);
		},


		/**
		 * Enables wait animation for button
		 * @param {HTMLElement} buttonNode
		 */
		enableWait: function(buttonNode)
		{
			BX.addClass(buttonNode, 'webform-small-button-wait');
			BX.removeClass(buttonNode, 'popup-window-button');
		},


		/**
		 * Disables wait animation for button
		 * @param {HTMLElement} buttonNode
		 */
		disableWait: function(buttonNode)
		{
			BX.removeClass(buttonNode, 'webform-small-button-wait');
			BX.addClass(buttonNode, 'popup-window-button');
		},


		/**
		 * Creates title of settings popup window
		 * @return {string}
		 */
		createTitle: function()
		{
			var tmpDiv = BX.create('div');
			var pageTitleNode = BX('pagetitle');
			var pageTitle = !!pageTitleNode ? '&laquo;'+pageTitleNode.innerText+'&raquo;' : '';
			tmpDiv.innerHTML = '<span>'+this.parent.getParam('SETTINGS_TITLE')+' '+pageTitle+'</span>';
			return tmpDiv.firstChild.innerText;
		},


		/**
		 * Gets popup id
		 * @return {string}
		 */
		getPopupId: function()
		{
			return this.parent.getContainerId() + '-grid-settings-window';
		},


		/**
		 * Creates grid settings popup window
		 * @return {BX.PopupWindow}
		 */
		createPopup: function()
		{
			this.popup = new BX.PopupWindow(
				this.getPopupId(),
				null,
				{
					titleBar: this.createTitle(),
					autoHide: false,
					overlay: 0.6,
					width: 800,
					closeIcon: true,
					closeByEsc: true,
					contentNoPaddings: true,
					content: this.getSourceContent(),
					events: {
						onPopupClose: BX.delegate(this.onPopupClose, this)
					}
				}
			);

			this.getItems().forEach(function(item) {
				BX.bind(item.getNode(), 'click', BX.delegate(this.onItemClick, this));
			}, this);

			BX.bind(this.getResetButton(), 'click', BX.proxy(this.onResetButtonClick, this));
			BX.bind(this.getApplyButton(), 'click', BX.proxy(this.onApplyButtonClick, this));
			BX.bind(this.getCancelButton(), 'click', BX.proxy(this.popup.close, this.popup));
			BX.bind(this.getSelectAllButton(), 'click', BX.delegate(this.onSelectAll, this));
			BX.bind(this.getUnselectAllButton(), 'click', BX.delegate(this.onUnselectAll, this));

			return this.popup;
		},

		onItemClick: function()
		{
			this.adjustActionButtonsState();
		},


		/**
		 * Gets columns collection
		 * @return {BX.Grid.SettingsWindowColumn[]}
		 */
		getItems: function()
		{
			if (this.items === null)
			{
				this.items = this.getPopupItems().map(function(current) {
					return new BX.Grid.SettingsWindowColumn(this.parent, current);
				}, this);
			}

			return this.items;
		},

		onPopupClose: function()
		{
			this.restoreLastColumns();
			this.disableAllColumnslabelEdit();
			this.adjustActionButtonsState();
		},


		/**
		 * Gets popup window
		 * @return {BX.PopupWindow}
		 */
		getPopup: function()
		{
			return !!this.popup ? this.popup : this.popup = this.createPopup();
		},

		onSelectAll: function()
		{
			this.selectAll();
			this.enableActions();
		},

		onUnselectAll: function()
		{
			this.unselectAll();
			this.disableActions();
		},

		/**
		 * Select all columns
		 */
		selectAll: function()
		{
			this.getItems().forEach(function(column) { column.select(); });
		},


		/**
		 * Unselect all columns
		 */
		unselectAll: function()
		{
			this.getItems().forEach(function(column) { column.unselect(); });
		},


		isForAll: function()
		{
			var checkbox = this.getForAllCheckbox();
			return checkbox && !!checkbox.checked;
		},


		/**
		 * Gets for all checkbox
		 * @return {?HTMLElement}
		 */
		getForAllCheckbox: function()
		{
			return BX.Grid.Utils.getByClass(this.getPopup().popupContainer, 'main-grid-settings-window-for-all-checkbox', true);
		},


		/**
		 * Gets reset button
		 * @return {?HTMLElement}
		 */
		getResetButton: function()
		{
			if (this.resetButton === null)
			{
				this.resetButton = BX(this.getResetButtonId());
			}

			return this.resetButton;
		},

		disableActions: function()
		{
			var applyButton = this.getApplyButton();

			if (!!applyButton)
			{
				BX.addClass(applyButton, this.parent.settings.get('classDisable'));
			}
		},

		enableActions: function()
		{
			var applyButton = this.getApplyButton();

			if (!!applyButton)
			{
				BX.removeClass(applyButton, this.parent.settings.get('classDisable'));
			}
		},

		adjustActionButtonsState: function()
		{
			if (this.getSelectedColumns().length)
			{
				this.enableActions();
			}
			else
			{
				this.disableActions();
			}
		}
	};

})();