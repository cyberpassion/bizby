import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

function InputWithLabel({ label, ...props }) {
    return (
        <div className={`col-span-6 space-y-1`}>
            <Label htmlFor={props.id}>{label}</Label>
            <Input {...props} />
        </div>
    );
}

export { InputWithLabel };
