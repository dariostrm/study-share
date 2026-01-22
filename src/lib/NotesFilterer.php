<?php

namespace lib;

use DateTime;

class NotesFilterer
{
    public static function filterNotes(array $notes, $search, $subject, $grade, $dateRange): array
    {
        //apply filters
        return array_filter($notes, function ($note) use ($search, $subject, $grade, $dateRange) {
            //search (title and description)
            if (!empty($search)) {
                $searchLower = strtolower($search);
                if (stripos($note->title, $searchLower) === false &&
                    stripos($note->description ?? '', $searchLower) === false) {
                    return false;
                }
            }
            //subject
            if (!empty($subject) && stripos($note->subject, $subject) === false) {
                return false;
            }
            //grade
            if (!empty($grade) && $note->grade !== (int)$grade) {
                return false;
            }
            //date range
            if (!empty($dateRange)) {
                $now = new DateTime();
                $noteDate = $note->date;
                switch ($dateRange) {
                    case 'today':
                        if ($noteDate->format('Y-m-d') !== $now->format('Y-m-d')) {
                            return false;
                        }
                        break;
                    case 'week':
                        $weekAgo = (clone($now))->modify('-7 days');
                        if ($noteDate < $weekAgo) {
                            return false;
                        }
                        break;
                    case 'month':
                        $monthAgo = (clone($now))->modify('-1 month');
                        if ($noteDate < $monthAgo) {
                            return false;
                        }
                        break;
                    case 'year':
                        $yearAgo = (clone($now))->modify('-1 year');
                        if ($noteDate < $yearAgo) {
                            return false;
                        }
                        break;
                }
            }

            return true;
        });
    }
}