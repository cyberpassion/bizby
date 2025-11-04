import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { useEffect, useState } from 'react';

function SelectWithLabel({
    label,
    id,
    placeholder,
    module,
    dataKey,
    col,
    ...props
}) {
    const [options, setOptions] = useState([]);
    const [selectedValue, setSelectedValue] = useState('');

    useEffect(() => {
        fetch(`http://bizby.test/api/v1/${module}/options/${dataKey}`)
            .then((response) => response.json())
            .then((res) => {
                // ✅ The API returns: { success: true, data: [ {label, value}, ... ] }
                if (res.success && Array.isArray(res.data)) {
                    setOptions(res.data);
                }
            })
            .catch((error) => {
                console.error('Error fetching select options:', error);
            });
    }, []);

    return (
        <div className={`col-span-${col}`}>
            <Label htmlFor={id}>{label}</Label>
            <Select onValueChange={setSelectedValue} {...props}>
                <SelectTrigger id={id}>
                    <SelectValue placeholder={placeholder || 'Select option'} />
                </SelectTrigger>
                <SelectContent>
                    {options.map((item) => (
                        <SelectItem key={item.value} value={item.value}>
                            {item.label}
                        </SelectItem>
                    ))}
                </SelectContent>
            </Select>
        </div>
    );
}

export { SelectWithLabel };
