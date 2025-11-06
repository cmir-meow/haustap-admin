// Admin notification UI initializer
// Injects dropdown markup and count bubble so client notify-ui can bind
(function(){
  function injectStyles(){
    try {
      var style = document.createElement('style');
      style.textContent = [
        '.hidden{display:none!important;}',
        '.notif-count{position:absolute; top:-6px; right:-6px; background:#ff3b30; color:#fff; border-radius:12px; padding:0 6px; font-size:12px; line-height:18px; min-width:18px; text-align:center; display:none;}',
        '.pulse{animation:bellPulse .8s ease-in-out;}',
        '@keyframes bellPulse{0%{transform:scale(1)}50%{transform:scale(1.15)}100%{transform:scale(1)}}'
      ].join('\n');
      document.head.appendChild(style);
    } catch(e){}
  }

  function ensureUi(){
    var userBox = document.querySelector('.topbar .user');
    var bellBtn = userBox && userBox.querySelector('.notif-btn');
    if (!userBox || !bellBtn) return;

    // Prepare anchoring
    try { userBox.style.position = 'relative'; } catch(e){}

    // Tag bell with expected id and add count bubble
    bellBtn.id = 'notifBellBtn';
    try { bellBtn.style.position = 'relative'; } catch(e){}
    if (!document.getElementById('notifCount')){
      var count = document.createElement('span');
      count.id = 'notifCount';
      count.className = 'notif-count';
      bellBtn.appendChild(count);
    }

    // Build dropdown if missing
    if (!document.getElementById('notifDropdown')){
      var dropdown = document.createElement('div');
      dropdown.id = 'notifDropdown';
      dropdown.className = 'notif-dropdown hidden';
      dropdown.setAttribute('aria-label','Notifications');
      dropdown.style.cssText = 'position:absolute; right:0; top:36px; width:320px; background:#fff; border:1px solid #e5e7eb; box-shadow:0 8px 24px rgba(0,0,0,0.12); border-radius:10px; overflow:hidden; z-index:999;';

      var header = document.createElement('div');
      header.className = 'notif-header';
      header.style.cssText = 'display:flex; justify-content:space-between; align-items:center; padding:10px 12px; background:#f7f9fa; border-bottom:1px solid #e5e7eb;';
      var strong = document.createElement('strong'); strong.textContent = 'Notifications';
      var markAll = document.createElement('button');
      markAll.type = 'button'; markAll.id = 'notifMarkAll';
      markAll.textContent = 'Mark all read';
      markAll.style.cssText = 'background:transparent; border:none; color:#3dbfc3; cursor:pointer;';
      header.appendChild(strong); header.appendChild(markAll);

      var list = document.createElement('ul');
      list.id = 'notifList'; list.className = 'notif-list';
      list.style.cssText = 'list-style:none; margin:0; padding:0; max-height:360px; overflow:auto;';

      var footer = document.createElement('div');
      footer.className = 'notif-footer';
      footer.style.cssText = 'padding:8px 12px; border-top:1px solid #e5e7eb; text-align:right;';
      var link = document.createElement('a'); link.href = '/bookings/booking.php';
      link.textContent = 'View bookings'; link.style.cssText = 'color:#3dbfc3; text-decoration:none; font-weight:500;';
      footer.appendChild(link);

      dropdown.appendChild(header);
      dropdown.appendChild(list);
      dropdown.appendChild(footer);
      userBox.appendChild(dropdown);
    }
  }

  if (document.readyState === 'loading'){
    document.addEventListener('DOMContentLoaded', function(){ injectStyles(); ensureUi(); });
  } else {
    injectStyles(); ensureUi();
  }
})();

