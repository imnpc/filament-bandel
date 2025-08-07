<?php

namespace Widiu7omo\FilamentBandel\Actions;

use Filament\Forms\Components\Textarea;
use Filament\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\Concerns\CanCustomizeProcess;

class BanBulkAction extends BulkAction
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'ban_bulk';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-bandel::translations.bulk-ban'));

        $this->successNotificationTitle(__('filament-bandel::translations.bulk-ban-success'));

        $this->color('primary');

        $this->icon('heroicon-o-lock-closed');

        $this->form(fn () => $this->getFormSchema());

        $this->action(function () {
            $this->process(function (array $data, Collection $records) {
                $records->filter(fn ($r) => !$r->banned_at)->each->ban([
                    'comment' => $data['comment'],
                    'expired_at' => $data['expired_at'],
                ]);
            });

            $this->success();
        });

        $this->deselectRecordsAfterCompletion();
    }

   public function getFormSchema(): array
   {
       return [
           Textarea::make('comment')->label(__('filament-bandel::translations.comment'))->rows(4),
           DatePicker::make('expired_at')->label(__('filament-bandel::translations.expired_at')),
       ];
   }
}
