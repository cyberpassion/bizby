import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

function InputWithLabel({ label, id, placeholder, col = 12, ...props }) {
    const colClass =
        {
            3: 'col-span-3',
            6: 'col-span-6',
            9: 'col-span-9',
        }[col] || 'col-span-12';

    return (
        <div className={`${colClass} space-y-1`}>
            <Label htmlFor={id}>{label}</Label>
            <Input id={id} placeholder={placeholder} {...props} />
        </div>
    );
}

export { InputWithLabel };
