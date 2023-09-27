<?php

namespace Widiu7omo\FilamentBandel\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions\Concerns\CanCustomizeProcess;

class UnbanAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'unban';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->successNotificationTitle(__('filament-bandel::translations.single-unban-success'));

        $this->color('primary');

        $this->icon('heroicon-o-lock-open');

        $this->action(function (): void {
            $this->process(function (Model $record) {
                $record->unban();
            });

            $this->success();
        });
    }
}
