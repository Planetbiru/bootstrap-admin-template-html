class MultiSelect {
    constructor(element, options = {}) {
        let defaults = {
            placeholder: 'Select item(s)',
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
            onChange: function() {},
            onSelect: function() {},
            onUnselect: function() {}
        };
        this.options = Object.assign(defaults, options);
        this.selectElement = typeof element === 'string' ? document.querySelector(element) : element;
        for (const prop in this.selectElement.dataset) {
            if (this.options[prop] !== undefined) {
                this.options[prop] = this.selectElement.dataset[prop];
            }
        }
        let name = this.selectElement.getAttribute('name') ? this.selectElement.getAttribute('name') : 'multi-select-' + Math.floor(Math.random() * 1000000);
        this.name = name.split('[]').join('');
        if (!this.options.data.length) {
            let options = this.selectElement.querySelectorAll('option');
            for (let i = 0; i < options.length; i++) {
                const parentOptgroup = options[i].closest('optgroup');
                if (parentOptgroup) {
                    const groupLabel = parentOptgroup.label;
                    if (!this.options.data.some(item => item.groupLabel === groupLabel)) {
                        this.options.data.push({ groupLabel: groupLabel, options: [] });
                    }
                    this.options.data.find(item => item.groupLabel === groupLabel).options.push({
                        value: options[i].value,
                        text: options[i].innerHTML,
                        selected: options[i].selected,
                        html: options[i].getAttribute('data-html')
                    });
                } else {
                    this.options.data.push({
                        value: options[i].value,
                        text: options[i].innerHTML,
                        selected: options[i].selected,
                        html: options[i].getAttribute('data-html')
                    });
                }
            }
        }
        this.element = this._template();
        this.selectElement.replaceWith(this.element);
        this._updateSelected();
        this._eventHandlers();
    }

    _template() {
        let optionsHTML = ''; // HTML for optgroup
        let nonSelectAllOptionsHTML = '';  // HTML for non-optgroup options
        let selectAllHTML = ''; // HTML for Select All
        
        let underOptgroupHTML = '';
    
        // Loop to process data
        for (let i = 0; i < this.data.length; i++) {
            if (this.data[i].groupLabel) {
                // This is an optgroup
                optionsHTML += `<div class="multi-select-optgroup">
                    <span class="multi-select-optgroup-label">${this.data[i].groupLabel}</span>
                    <div class="multi-select-optgroup-options">`;
    
                // Loop through each option in the optgroup
                for (let j = 0; j < this.data[i].options.length; j++) {
                    underOptgroupHTML += `
                        <div class="multi-select-option-container">
                            <div class="multi-select-option${this.selectedValues.includes(this.data[i].options[j].value) ? ' multi-select-selected' : ''}" data-value="${this.data[i].options[j].value}">
                                <span class="multi-select-option-radio"></span>
                                <span class="multi-select-option-text">${this.data[i].options[j].html ? this.data[i].options[j].html : this.data[i].options[j].text}</span>
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
                        <div class="multi-select-option${this.selectedValues.includes(this.data[i].value) ? ' multi-select-selected' : ''}" data-value="${this.data[i].value}">
                            <span class="multi-select-option-radio"></span>
                            <span class="multi-select-option-text">${this.data[i].html ? this.data[i].html : this.data[i].text}</span>
                        </div>
                    </div>
                `;
            }
        }
            
        // If 'Select All' is enabled, add HTML for Select All
        if (this.options.selectAll === true || this.options.selectAll === 'true') {
            selectAllHTML = `<div class="multi-select-all">
                <span class="multi-select-option-radio"></span>
                <span class="multi-select-option-text">Select all</span>
            </div>`;
        }
        
    
        // Combine all HTML into one template
        let template = `
            <div class="multi-select ${this.name}"${this.selectElement.id ? ' id="' + this.selectElement.id + '"' : ''} style="${this.width ? 'width:' + this.width + ';' : ''}${this.height ? 'height:' + this.height + ';' : ''}">
                ${this.selectedValues.map(value => `<input type="hidden" name="${this.name}[]" value="${value}">`).join('')}
                <div class="multi-select-header" style="${this.width ? 'width:' + this.width + ';' : ''}${this.height ? 'height:' + this.height + ';' : ''}">
                    <span class="multi-select-header-max">${this.options.max ? this.selectedValues.length + '/' + this.options.max : ''}</span>
                    <span class="multi-select-header-placeholder">${this.placeholder}</span>
                </div>
                <div class="multi-select-options" style="${this.options.dropdownWidth ? 'width:' + this.options.dropdownWidth + ';' : ''}${this.options.dropdownHeight ? 'height:' + this.options.dropdownHeight + ';' : ''}">
                    ${this.options.search === true || this.options.search === 'true' ? '<input type="text" class="multi-select-search" placeholder="Search...">' : ''}
                    ${selectAllHTML}  <!-- 'Select All' outside the options list -->
                    <div class="multi-select-options-container">
                    <div class="multi-select-options-list">${nonSelectAllOptionsHTML}</div> <!-- Non-'Select All' options -->
                    <div class="multi-select-optgroup-list">${optionsHTML}</div> <!-- Options inside optgroup -->
                    </div>
                </div>
            </div>
        `;
        
        let element = document.createElement('div');
        element.innerHTML = template;
        return element;
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
                    this.element.querySelector('.multi-select').insertAdjacentHTML('afterbegin', `<input type="hidden" name="${this.name}[]" value="${option.dataset.value}">`);
                    try
                    {
                    this.data.filter(data => data.value == option.dataset.value)[0].selected = true;
                    }
                    catch(e)
                    {
                        
                    }
                } else {
                    option.classList.remove('multi-select-selected');
                    this.element.querySelectorAll('.multi-select-header-option').forEach(headerOption => headerOption.dataset.value == option.dataset.value ? headerOption.remove() : '');
                    this.element.querySelector(`input[value="${option.dataset.value}"]`).remove();
                    try
                    {
                        this.data.filter(data => data.value == option.dataset.value)[0].selected = false;
                    }
                    catch(e)
                    {
                        
                    }
                    selected = false;
                }
                if (this.options.listAll === false || this.options.listAll === 'false') {
                    if (this.element.querySelector('.multi-select-header-option')) {
                        this.element.querySelector('.multi-select-header-option').remove();
                    }
                    headerElement.insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option">${this.selectedValues.length} selected</span>`);
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
            };
        });

        headerElement.onclick = () => headerElement.classList.toggle('multi-select-header-active');

        if (this.options.search === true || this.options.search === 'true') {
            let search = this.element.querySelector('.multi-select-search');
            search.oninput = () => {
                this.element.querySelectorAll('.multi-select-option').forEach(option => {
                    option.style.display = option.querySelector('.multi-select-option-text').innerHTML.toLowerCase().indexOf(search.value.toLowerCase()) > -1 ? 'flex' : 'none';
                });
            };
        }

        if (this.options.selectAll === true || this.options.selectAll === 'true') {
            let selectAllButton = this.element.querySelector('.multi-select-all');
            selectAllButton.onclick = () => {
                let allSelected = selectAllButton.classList.contains('multi-select-selected');
                this.element.querySelectorAll('.multi-select-option').forEach(option => {
                    let dataItem = this.data.find(data => data.value == option.dataset.value);
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
        } else {
            // If not showing all options, just show how many options are selected
            if (this.selectedValues.length > 0) {
                // Add the number of selected options to the header
                this.element.querySelector('.multi-select-header').insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option">${this.selectedValues.length} selected</span>`);
            }
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
}
