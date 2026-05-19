<style type="text/css">
/* ============================================================
   Driving module styling: dashboard, badges, capacity cards.
   ============================================================ */

.dv-toolbar {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}
.dv-toolbar .form-control { display: inline-block; width: auto; }
.dv-toolbar form { margin: 0; }

.dv-summary {
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
    margin: 14px 0 18px;
}
@media (min-width: 600px)  { .dv-summary { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 992px)  { .dv-summary { grid-template-columns: repeat(5, 1fr); } }

.dv-summary .dv-stat,
.dv-summary .dv-capacity {
    background: #fff;
    border: 1px solid #e3e3e3;
    border-radius: 6px;
    padding: 8px 12px;
    box-shadow: 0 1px 2px rgba(0,0,0,.04);
}

.dv-stat-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}
.dv-stat-left   { flex: 1; min-width: 0; }
.dv-stat-title  { font-size: 12px; color: #7b7b7b; text-transform: uppercase; letter-spacing: .3px; margin: 0; }
.dv-stat-value  { font-size: 20px; font-weight: 700; color: #2f3a4a; margin: 0; white-space: nowrap; line-height: 1.2; }
.dv-stat-sub    { font-size: 11px; color: #9aa3ad; margin: 2px 0 0; }

.dv-capacity                  { position: relative; }
.dv-capacity-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}
.dv-capacity-title            { font-size: 14px; font-weight: 600; color: #2f3a4a; flex: 1; min-width: 0; margin: 0; line-height: 1.3; }
.dv-capacity-value            { font-size: 16px; font-weight: 700; color: #2f3a4a; margin: 0; white-space: nowrap; line-height: 1.2; }
.dv-capacity-bar              { height: 4px; background: #eef0f3; border-radius: 4px; overflow: hidden; margin-top: 6px; }
.dv-capacity-bar > span       { display: block; height: 100%; background: #1abc9c; border-radius: 4px; transition: width .25s ease; }
.dv-capacity-ok  .dv-capacity-bar > span { background: #28a745; }
.dv-capacity-high .dv-capacity-bar > span { background: #f0ad4e; }
.dv-capacity-full .dv-capacity-bar > span { background: #d9534f; }
.dv-capacity-full             { border-color: #f5c2c0; }

/* Pivot table */
.dv-pivot                     { border-collapse: separate; border-spacing: 0; width: 100%; }
.dv-pivot th, .dv-pivot td    { vertical-align: middle; }
.dv-pivot thead th            { background: #2f3a4a; color: #fff; padding: 10px 12px; font-weight: 600; }
.dv-pivot thead th:first-child{ border-top-left-radius: 6px; }
.dv-pivot thead th:last-child { border-top-right-radius: 6px; }
.dv-pivot tbody td            { padding: 10px 12px; border-bottom: 1px solid #eef0f3; background: #fff; }
.dv-pivot tbody tr:hover td   { background: #f8fafc; }
.dv-pivot .dv-cell            { text-align: center; min-width: 110px; }
.dv-pivot .dv-cell-actions    { margin-top: 0; }
.dv-pivot .dv-cell-actions .btn { padding: 1px 6px; font-size: 11px; }

/* Status badges */
.dv-badge {
    display: inline-block;
    min-width: 64px;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
    text-align: center;
    letter-spacing: .2px;
}
.dv-badge-queued    { background: #f0ad4e; color: #5a3a00; }
.dv-badge-driving   { background: #e67e22; color: #fff; min-width: 92px; }
.dv-badge-completed { background: #28a745; }
.dv-badge-cancelled { background: #adb5bd; }
.dv-badge-empty     { background: transparent; color: #adb5bd; font-weight: 400; }

/* Empty-state styling for cells with no driving record yet */
.dv-pivot td.dv-empty {
    color: #adb5bd;
    background: #fafbfc;
    font-style: italic;
}

/* Timeline (used on details + learner history pages) */
.dv-timeline                  { list-style: none; padding: 0; margin: 0; }
.dv-timeline li               { position: relative; padding: 4px 0 4px 20px; }
.dv-timeline li::before {
    content: '';
    position: absolute;
    left: 6px; top: 12px;
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #bbb;
}
.dv-timeline li.stage-Queued::before    { background: #f0ad4e; }
.dv-timeline li.stage-Driving::before   { background: #e67e22; }
.dv-timeline li.stage-Completed::before { background: #28a745; }
.dv-timeline li.stage-Cancelled::before { background: #adb5bd; }
.dv-timeline li:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 10px; top: 18px;
    width: 0; height: 100%;
    border-left: 1px dashed #ddd;
}
.dv-timeline .ts { color: #7b7b7b; font-size: 12px; margin-left: 6px; }

.dv-log-table { margin: 0; font-size: 13px; }
.dv-log-table th { background: #f5f6f8; font-weight: 600; white-space: nowrap; }
.dv-log-table td { vertical-align: middle !important; }
.dv-log-table .dv-badge { font-size: 11px; }

/* Assign queue modal */
.dv-assign-form .form-group  { margin-bottom: 12px; }
.dv-assign-form label        { font-weight: 600; }
.dv-inline-radios            { margin-top: 6px; }
.dv-inline-radios .radio-inline {
    margin-right: 16px;
    margin-bottom: 6px;
    font-weight: normal;
}

/* History filter strip */
.dv-filter-strip {
    background: #fafbfc;
    border: 1px solid #e3e3e3;
    border-radius: 6px;
    padding: 12px;
    margin-bottom: 16px;
}
.dv-filter-strip .form-group { margin-bottom: 8px; }
</style>
