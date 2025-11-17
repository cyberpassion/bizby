import { ChevronDownIcon } from 'lucide-react';
import * as React from 'react';

import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Label } from '@/components/ui/label';
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover';

export function CalendarWithLabel({ label, id, col = 12, ...props }) {
    const [open, setOpen] = React.useState(false);
    const [date, setDate] = (React.useState < Date) | (undefined > undefined);

    const colClass =
        {
            3: 'col-span-3',
            6: 'col-span-6',
            9: 'col-span-9',
        }[col] || 'col-span-12';
    return (
        <div className={`${colClass} space-y-1`}>
            <Label htmlFor={id} className="px-1">
                {label}
            </Label>
            <Popover open={open} onOpenChange={setOpen}>
                <PopoverTrigger asChild>
                    <Button
                        variant="outline"
                        id={id}
                        className="w-48 justify-between font-normal"
                    >
                        {date ? date.toLocaleDateString() : 'Select date'}
                        <ChevronDownIcon />
                    </Button>
                </PopoverTrigger>
                <PopoverContent
                    className="w-auto overflow-hidden p-0"
                    align="start"
                >
                    <Calendar
                        mode="single"
                        selected={date}
                        captionLayout="dropdown"
                        onSelect={(date) => {
                            setDate(date);
                            setOpen(false);
                        }}
                    />
                </PopoverContent>
            </Popover>
        </div>
    );
}
