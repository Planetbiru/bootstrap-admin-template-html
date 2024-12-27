class MultiSelect {
    constructor(element, options = {}) {
        let defaults = {
            placeholder: 'Select item(s)',
            searchPlaceholder: 'Search...',
            labelSelectAll: 'Select all',
            labelSelected: 'selected',
            max: null,
            search: true,
            selectAll: true,
            listAll: true,
            closeListOnItemSelect: false,
            name: '',
            width: '',
            height: '',
            dropdownWidth: '',
            dropdownHeight: '',
            data: [],
            onChange: function () { },
            onSelect: function () { },
            onUnselect: function () { }
        };
        this.options = Object.assign(defaults, options);
        this.selectElement = typeof element === 'string' ? document.querySelector(element) : element;
        for (const prop in this.selectElement.dataset) {
            if (this.options[prop] !== undefined) {
                this.options[prop] = this.selectElement.dataset[prop];
            }
        }
        let name = this._getName();
        this.name = name.split('[]').join('');
        if (!this.options.data.length) {
            let options = this.selectElement.querySelectorAll('option');
            for (const option of options) {
                const parentOptgroup = option.closest('optgroup');
                if (parentOptgroup) {
                    const groupLabel = parentOptgroup.label;
                    if (!this.options.data.some(item => item.groupLabel === groupLabel)) {
                        this.options.data.push({ groupLabel: groupLabel, options: [] });
                    }
                    this.options.data.find(item => item.groupLabel === groupLabel).options.push({
                        value: option.value,
                        text: option.innerHTML,
                        selected: option.selected,
                        html: option.getAttribute('data-html')
                    });
                } else {
                    this.options.data.push({
                        value: option.value,
                        text: option.innerHTML,
                        selected: option.selected,
                        html: option.getAttribute('data-html')
                    });
                }
            }            
        }
        this.element = this._template();
        this.selectElement.replaceWith(this.element);
        this._updateSelected();
        this._eventHandlers();
    }

    _getName()
    {
        return this.selectElement.getAttribute('name') ? this.selectElement.getAttribute('name') : 'multi-select-' + Math.floor(Math.random() * 1000000);
    }

    _template() {
        let optionsHTML = ''; // HTML for optgroup
        let nonSelectAllOptionsHTML = '';  // HTML for non-optgroup options
        let selectAllHTML = ''; // HTML for Select All


        // Loop to process data
        let underOptgroupHTML = ''; // Initialize variable for optgroup options
        for (const group of this.data) {
            if (group.groupLabel) {
                // This is an optgroup
                optionsHTML += `<div class="multi-select-optgroup">
                    <span class="multi-select-optgroup-label">${group.groupLabel}</span>
                    <div class="multi-select-optgroup-options">`;

                // Loop through each option in the optgroup
                for (const option of group.options) {
                    underOptgroupHTML += `
                        <div class="multi-select-option-container">
                            <div class="multi-select-option${this._getSelectedClass(option.value)}" data-value="${option.value}">
                                <span class="multi-select-option-radio"></span>
                                <span class="multi-select-option-text">${_getText(option)}</span>
                            </div>
                        </div>
                    `;
                }
                optionsHTML += underOptgroupHTML + `</div></div>`; // End the optgroup
                underOptgroupHTML = ''; // Reset for the next option
            } else {
                // Options outside the optgroup
                nonSelectAllOptionsHTML += `
                    <div class="multi-select-option-container">
                        <div class="multi-select-option${this._getSelectedClass(group.value)}" data-value="${group.value}">
                            <span class="multi-select-option-radio"></span>
                            <span class="multi-select-option-text">${this._getText(group)}</span>
                        </div>
                    </div>
                `;
            }
        }


        // If 'Select All' is enabled, add HTML for Select All
        if (this.options.selectAll === true || this.options.selectAll === 'true') {
            selectAllHTML = `<div class="multi-select-all">
                <span class="multi-select-option-radio"></span>
                <span class="multi-select-option-text">${this.options.labelSelectAll}</span>
            </div>`;
        }

        // Combine all HTML into one template
        let template = `
            <div class="multi-select ${this.name}"${this.selectElement.id ? ' id="' + this.selectElement.id + '"' : ''} style="${this._getDimension()}">
                <div class="multi-select-hidden-input-area" style="display:none;">
                ${this.selectedValues.map(value => `<input type="hidden" name="${this.name}[]" value="${value}">`).join('')}
                </div>
                <div class="multi-select-header" style="${this._getDimension()}">
                    <span class="multi-select-header-max">${this.options.max ? this.selectedValues.length + '/' + this.options.max : ''}</span>
                    <span class="multi-select-header-placeholder">${this.placeholder}</span>
                </div>
                <div class="multi-select-options" style="${this.options.dropdownWidth ? 'width:' + this.options.dropdownWidth + ';' : ''}${this.options.dropdownHeight ? 'height:' + this.options.dropdownHeight + ';' : ''}">
                    ${this.options.search === true || this.options.search === 'true' ? `<input type="text" class="multi-select-search" placeholder="${this.options.searchPlaceholder}">` : ''}
                    ${selectAllHTML} 
                    <div class="multi-select-options-container">
                    <div class="multi-select-options-list">${nonSelectAllOptionsHTML}</div> 
                    <div class="multi-select-optgroup-list">${optionsHTML}</div> 
                    </div>
                </div>
            </div>
        `;

        let element = document.createElement('div');
        element.innerHTML = template;
        return element;
    }

    _getText(option)
    {
        return `${option.html ? option.html : option.text}`;
    }

    _getSelectedClass(value)
    {
        return `${this.selectedValues.includes(value) ? ' multi-select-selected' : ''}`;
    }

    _getDimension()
    {
        return `${this.width ? 'width:' + this.width + ';' : ''}${this.height ? 'height:' + this.height + ';' : ''}`;
    }

    _updateOption(selected)
    {
        if (this.options.listAll === false || this.options.listAll === 'false') {
            if (this.element.querySelector('.multi-select-header-option')) {
                this.element.querySelector('.multi-select-header-option').remove();
            }
            headerElement.insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option">${this.selectedValues.length} ${this.options.labelSelected}</span>`);
        }
        if (!this.element.querySelector('.multi-select-header-placeholder')) {
            headerElement.insertAdjacentHTML('afterbegin', `<span class="multi-select-header-placeholder">${this.placeholder}</span>`);
        }
        if (this.options.max) {
            this.element.querySelector('.multi-select-header-max').innerHTML = this.selectedValues.length + '/' + this.options.max;
        }
        if (this.options.search === true || this.options.search === 'true') {
            this.element.querySelector('.multi-select-search').value = '';
        }
        this.element.querySelectorAll('.multi-select-option').forEach(option => option.style.display = 'flex');
        if (this.options.closeListOnItemSelect === true || this.options.closeListOnItemSelect === 'true') {
            headerElement.classList.remove('multi-select-header-active');
        }
        this.options.onChange(option.dataset.value, option.querySelector('.multi-select-option-text').innerHTML, option);
        if (selected) {
            this.options.onSelect(option.dataset.value, option.querySelector('.multi-select-option-text').innerHTML, option);
        } else {
            this.options.onUnselect(option.dataset.value, option.querySelector('.multi-select-option-text').innerHTML, option);
        }
    }


    _eventHandlers() {
        let headerElement = this.element.querySelector('.multi-select-header');
        this.element.querySelectorAll('.multi-select-option').forEach(option => {
            
            option.onclick = () => {
                let selected = true;
                
                if (!option.classList.contains('multi-select-selected')) {
                    if (this.options.max && this.selectedValues.length >= this.options.max) {
                        return;
                    }
                    option.classList.add('multi-select-selected');
                    if (this.options.listAll === true || this.options.listAll === 'true') {
                        if (this.element.querySelector('.multi-select-header-option')) {
                            let opt = Array.from(this.element.querySelectorAll('.multi-select-header-option')).pop();
                            opt.insertAdjacentHTML('afterend', `<span class="multi-select-header-option" data-value="${option.dataset.value}">${option.querySelector('.multi-select-option-text').innerHTML}</span>`);
                        } else {
                            headerElement.insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option" data-value="${option.dataset.value}">${option.querySelector('.multi-select-option-text').innerHTML}</span>`);
                        }
                    }
                    this.element.querySelector('.multi-select .multi-select-hidden-input-area').insertAdjacentHTML('beforeend', `<input type="hidden" name="${this.name}[]" value="${option.dataset.value}">`);
                    try {
                        this.data.filter(data => data.value == option.dataset.value)[0].selected = true;
                    }
                    catch (e) {
                        // Do nothing
                    }
                } else {
                    option.classList.remove('multi-select-selected');
                    this.element.querySelectorAll('.multi-select-header-option').forEach(headerOption => headerOption.dataset.value == option.dataset.value ? headerOption.remove() : '');
                    this.element.querySelector(`input[value="${option.dataset.value}"]`).remove();
                    try {
                        this.data.filter(data => data.value == option.dataset.value)[0].selected = false;
                    }
                    catch (e) {

                    }
                    selected = false;
                }
                this._updateOption(selected);
            };
        });

        headerElement.onclick = () => headerElement.classList.toggle('multi-select-header-active');

        if (this.options.search === true || this.options.search === 'true') {
            let search = this.element.querySelector('.multi-select-search');
            search.oninput = () => {
                this.element.querySelectorAll('.multi-select-option').forEach(option => {
                    option.parentNode.style.display = option.querySelector('.multi-select-option-text').innerHTML.toLowerCase().indexOf(search.value.toLowerCase()) > -1 ? 'flex' : 'none';
                });
            };
        }

        if (this.options.selectAll === true || this.options.selectAll === 'true') {
            let selectAllButton = this.element.querySelector('.multi-select-all');
            selectAllButton.onclick = () => {
                let allSelected = selectAllButton.classList.contains('multi-select-selected');

                // remove all hidden input
                selectAllButton.closest('.multi-select')
                const hiddenInputs = selectAllButton.closest('.multi-select').querySelectorAll('input[type="hidden"]');
                if(hiddenInputs != null)
                {
                    hiddenInputs.forEach(input => input.remove());
                }
                
                this.element.querySelectorAll('.multi-select-option').forEach(option => {
                    this.data.find(data => data.value == option.dataset.value);
                    if(!allSelected)
                    {
                        option.classList.remove('multi-select-selected');
                    }
                    option.click();
                });
                selectAllButton.classList.toggle('multi-select-selected');
            };
        }

        if (this.selectElement.id && document.querySelector('label[for="' + this.selectElement.id + '"]')) {
            document.querySelector('label[for="' + this.selectElement.id + '"]').onclick = () => {
                headerElement.classList.toggle('multi-select-header-active');
            };
        }

        document.addEventListener('click', event => {
            if (!event.target.closest('.' + this.name) && !event.target.closest('label[for="' + this.selectElement.id + '"]')) {
                headerElement.classList.remove('multi-select-header-active');
            }
        });
    }

    _updateSelected() {
        const headerElement = this.element.querySelector('.multi-select-header');

        // If listAll is true, we update the selected options
        if (this.options.listAll === true || this.options.listAll === 'true') {
            // Update selected options for the header
            this.element.querySelectorAll('.multi-select-option').forEach(option => {
                if (option.classList.contains('multi-select-selected')) {
                    // Add selected options to header (it could be multiple)
                    this.element.querySelector('.multi-select-header').insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option" data-value="${option.dataset.value}">${option.querySelector('.multi-select-option-text').innerHTML}</span>`);
                }
            });
        } else if (this.selectedValues.length > 0) {
            // If not showing all options, just show how many options are selected
            // Add the number of selected options to the header
            this.element.querySelector('.multi-select-header').insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option">${this.selectedValues.length} ${this.options.labelSelected}</span>`);
        
        }

        // Remove all placeholders (if there are multiple) before adding the new one
        this.element.querySelectorAll('.multi-select-header-placeholder').forEach(placeholder => {
            placeholder.remove();
        });

        // Add a new placeholder if there are no selected options
        if (!this.element.querySelector('.multi-select-header-option')) {
            headerElement.insertAdjacentHTML('afterbegin', `<span class="multi-select-header-placeholder">${this.placeholder}</span>`);
        }
    }


    get selectedValues() {
        return this.data.flatMap(item => item.options ? item.options.filter(option => option.selected).map(option => option.value) : []);
    }

    get selectedItems() {
        return this.data.flatMap(item => item.options ? item.options.filter(option => option.selected) : []);
    }

    set data(value) {
        this.options.data = value;
    }

    get data() {
        return this.options.data;
    }

    set selectElement(value) {
        this.options.selectElement = value;
    }

    get selectElement() {
        return this.options.selectElement;
    }

    set element(value) {
        this.options.element = value;
    }

    get element() {
        return this.options.element;
    }

    set placeholder(value) {
        this.options.placeholder = value;
    }

    get placeholder() {
        return this.options.placeholder;
    }

    set name(value) {
        this.options.name = value;
    }

    get name() {
        return this.options.name;
    }

    set width(value) {
        this.options.width = value;
    }

    get width() {
        return this.options.width;
    }

    set height(value) {
        this.options.height = value;
    }

    get height() {
        return this.options.height;
    }
    
    set searchPlaceholder(value) {
        this.options.searchPlaceholder = value;
    }

    get searchPlaceholder() {
        return this.options.searchPlaceholder;
    }
    
    set labelSelectAll(value) {
        this.options.labelSelectAll = value;
    }

    get labelSelectAll() {
        return this.options.labelSelectAll;
    }
    
    set labelSelected(value) {
        this.options.labelSelected = value;
    }

    get labelSelected() {
        return this.options.labelSelected;
    }
    
}
