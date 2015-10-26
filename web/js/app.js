var StatisticManager = function()
{
  this.send = function()
  {
    var data = {
      page_title: '',
      page_url: '',
      ref_page_url: '',
      browser_data: '',
      scroll_percentage: '',
      screen_size: '',
      spend_time: 0
    };

    $.ajax({
      url: '?r=statistics',
      method: 'POST',
      data: data
    });
  };
};

var JSCRUD = function(container, modelName, addToEnd = false)
{
  this.container = $(container);
  this.modelName = modelName;
  this.addToEnd = addToEnd;

  this.modelClass = function()
  {
    return '.js-' + this.modelName + '-item';
  };

  this.modelIdAttr = function(id)
  {
    return '[data-' + this.modelName + '-id="' + id + '"]';
  };

  this.find = function(id)
  {
    return this.container.find(this.modelClass() + this.modelIdAttr(id));
  };

  this.add = function(html)
  {
    var item = $(html);

    item.hide(0);

    if(this.addToEnd)
    {
      this.container.append(item);
    }else{
      this.container.prepend(item);
    }

    item.show();

  };

  this.update = function(html)
  {
    var id = $(html).attr('data-' + this.modelName + '-id');
    this.find(id).replaceWith(html);
  };

  this.delete = function(id)
  {
    this.find(id).hide(0);
  };
};

var ModalFormSubmitter = function()
{
  $(document).delegate('.js-modal-form [type="submit"]', 'click', function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).parents('.js-modal-form').find('form').trigger('submit');
  });
};

var RemoteFormsManager = function()
{
  $(document).delegate('.js-remote-form', 'submit', function(e){
    var form = $(this);
    form.addClass('js-loading');
    form.attr('disabled', true);

    e.preventDefault();
    e.stopPropagation();

    $.ajax({
      url: form.attr('action'),
      method: form.attr('method'),
      data: form.serialize(),
      success: function(response_data, textStatus, jqXHR)
      {
        form.trigger('reset');
        eval(response_data);
      },
      complete: function()
      {
        form.removeClass('js-loading');
        form.removeAttr('disabled');
      }
    });
  });

  $(document).delegate('.js-remote-link', 'click', function(e){
    e.preventDefault();
    e.stopPropagation();
    $.ajax({
      url: $(this).attr('href'),
      method: 'GET',
      success: function(response_data, textStatus, jqXHR)
      {
        eval(response_data);
      }
    });
  });
};

var ImageUploadForm = function()
{
  this.sendForm = function(form)
  {
    var form_data = new FormData(form.get(0));

    $.ajax({
      type: 'POST',
      data: form_data,
      url: form.attr('action'),
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data, textStatus, jqXHR){
        eval(data);
      }
    });
  };

  this.bindEvents = function()
  {
    var self = this;

    $(document).delegate('form.js-image-upload-form input[type="file"]', 'change', function(e){
      var file = e.target.files.item(0);
      var reader = new FileReader();
      var form = $(this).parents('form:first');
      reader.onload = function(e){
        form.find('img').attr('src', e.target.result);
      };
      reader.readAsDataURL(file);
      self.sendForm(form);
    });

    $(document).delegate('form.js-image-upload-form .js-select-file', 'click', function(e){
      e.preventDefault();
      var form = $(this).parents('form:first');
      form.find('input[type="file"]').trigger('click');
    });
  };

  this.init = function()
  {
    this.bindEvents();
  };

  this.init();
};

window.App = {
  initDateTimePickers: function()
  {
    ;
  },

  initModalFormSubmitter: function()
  {
    new ModalFormSubmitter();
  },

  initImageUploadForm: function()
  {
    new ImageUploadForm();
  },

  initRemoteForms: function()
  {
    new RemoteFormsManager();
  },

  initLoginModal: function()
  {
    $(document).delegate('.js-login-button', 'click', function(e){
      e.preventDefault();

      $('#login_modal .js-sign-in, #login_modal  .js-sign-up').hide(0);
      if($(this).attr('data-form') == 'sign-in')
      {
        $('#login_modal .js-sign-in').show(0);
      }else{
        $('#login_modal  .js-sign-up').show(0);
      }

      $('#login_modal').modal().show(0);
    });

    $(document).delegate('#login_modal .js-sign-in-button', 'click', function(e){
      e.preventDefault();
      $('#login_modal  .js-sign-up').hide(0);
      $('#login_modal  .js-sign-in').show(0);
    });

    $(document).delegate('#login_modal .js-sign-up-button', 'click', function(e){
      e.preventDefault();
      $('#login_modal  .js-sign-in').hide(0);
      $('#login_modal  .js-sign-up').show(0);
    });
  },


  init: function()
  {
    //bind events
    //init all components
    this.initDateTimePickers();
    this.initModalFormSubmitter();
    this.initImageUploadForm();
    this.initRemoteForms();
    this.initLoginModal();
  },


  bind_events: function()
  {
    var self = this;
    $(document).delegate('body', 'loaded', function(){
      self.init();
    });
  },

  run: function()
  {
    this.bind_events();
    $('body').trigger('loaded');
  },

  //utilites
  alert: function(type, content)
  {
    alert(content);
  },

  showModal: function(content)
  {
    var modal = $(content);
    var modal_id = '#' + modal.attr('id');

    if($(modal_id).length > 0)
    {
      $(modal_id).html(modal.html());
    }else{
      $('body').append(modal);
    }

    if($(modal_id).is(':visible'))
    {
      return;
    }

    $(modal_id).modal('show');

    $(modal_id).find('script').each(function(){
      eval(this.html());
    });
  },

  hideModal: function(content)
  {
    var modal = $(content);
    var modal_id = '#' + modal.attr('id');

    $(modal_id).modal('hide');
  }

};

$(document).ready(function(){
  window.App.run();
});
