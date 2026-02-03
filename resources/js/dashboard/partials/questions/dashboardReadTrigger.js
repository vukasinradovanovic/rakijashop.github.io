/**
 * Marks unread question as read via AJAX, then navigates to details.
 * Uses mark URL from data-mark-url rendered by Blade (route('dashboard-questions.mark-as-read', $question)).
 */
export function initDashboardReadTrigger() {
  const $list = $('.dashboard_questionsList');
  if (!$list.length) return;

  $list.on('click', '.dashboard_questionsItem a.stretched-link', function (e) {
    const $row = $(this).closest('.dashboard_questionsItem');
    const isNew = $row.hasClass('is-new');
    if (!isNew) return; // već pročitano -> pusti default navigaciju

    e.preventDefault();

    const href = $(this).attr('href');
    const markUrl = $row.data('markUrl');
    if (!markUrl) { window.location.href = href; return; }

    // Optimistički update UI-a
    $row.removeClass('is-new').addClass('is-old');

    $.ajax({
      url: markUrl,
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      complete: () => window.location.href = href // uvek idi na detalje
    });
  });
}
