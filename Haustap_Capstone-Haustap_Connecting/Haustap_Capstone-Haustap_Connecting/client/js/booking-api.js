// Lightweight Booking API helper for the legacy UI
// Relies on window.API_BASE configured by /login_sign up/js/api.js
(function() {
  const API_BASE = (window.API_BASE || '').replace(/\/+$/, '') || 'http://127.0.0.1:8001';

  function getToken() {
    return localStorage.getItem('haustap_token') || '';
  }

  async function request(path, opts) {
    const url = `${API_BASE}${path}`;
    const headers = Object.assign({
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    }, opts && opts.headers);
    const token = getToken();
    if (token) {
      headers['Authorization'] = `Bearer ${token}`;
    }
    const fetchOpts = Object.assign({ method: 'GET', headers }, opts);
    const res = await fetch(url, fetchOpts);
    const ct = res.headers.get('content-type') || '';
    let data = null;
    if (ct.includes('application/json')) {
      data = await res.json();
    } else {
      const text = await res.text();
      try { data = JSON.parse(text); } catch { data = { message: text }; }
    }
    if (!res.ok) {
      const message = (data && (data.message || data.error)) || `HTTP ${res.status}`;
      const err = new Error(message);
      err.response = res;
      err.data = data;
      throw err;
    }
    return data;
  }

  async function createBooking(payload) {
    return request('/bookings', { method: 'POST', body: JSON.stringify(payload) });
  }

  async function listBookings(query) {
    const qs = query ? `?${new URLSearchParams(query).toString()}` : '';
    return request('/bookings' + qs, { method: 'GET' });
  }

  async function updateStatus(id, status) {
    return request(`/bookings/${id}/status`, { method: 'POST', body: JSON.stringify({ status }) });
  }

  async function cancelBooking(id) {
    return request(`/bookings/${id}/cancel`, { method: 'POST' });
  }

  async function rateBooking(id, rating) {
    return request(`/bookings/${id}/rate`, { method: 'POST', body: JSON.stringify({ rating }) });
  }

  window.HausTapBookingAPI = {
    createBooking,
    listBookings,
    updateStatus,
    cancelBooking,
    rateBooking,
    getToken,
    API_BASE,
  };
})();
